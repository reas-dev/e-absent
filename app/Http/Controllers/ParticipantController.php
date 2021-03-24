<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use App\Participant;
use App\Attendance;
use App\TimeStatus;
use Carbon\Carbon;
use Victorybiz\GeoIPLocation\GeoIPLocation;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    public function showAbsent(){
        return view('participant.absent');
    }

    public function absent(Request $request){
        $request->validate([
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        $geoip = new GeoIPLocation();
        $myIp = $geoip->getIP();

        $latitude = $request->latitude;
        $longitude = $request->longitude;

        // $latitude = $geoip->getLatitude();
        // $longitude = $geoip->getLongitude();

        $id = Auth::user()->id;
        $participant_check = Participant::where('user_id', $id)->first();
        if($participant_check == null){
            return redirect('/participant/absent')->with('status', 'nik-not-found');
        }

        $date_now = Carbon::now();

        $day = $date_now->day;
        $day = ltrim($day, '0');

        $month = $date_now->month;
        $year = $date_now->year;

        $day_int = date('N', strtotime($date_now->format('l')));

        if($day_int == 6 || $day_int == 7){
            return redirect('/participant/absent')->with('status', 'no-weekday');
        }

        $attendance_check = Attendance::where('participant_id', $participant_check->id)->where('day', $day)->where('month', $month)->where('year', $year)->first();
        if($attendance_check != null){
            return redirect('/participant/absent')->with('status', 'have-attend');
        }
        $time_set = TimeStatus::first();
        $late_time = $time_set->late;
        $attend_time = $time_set->attend;
        $time_now = $date_now->format('H:i:s');

        $date_now_format = $date_now->format('Y-m-d');

        /**
            NEED CHANGE ATTENDANCE START DATE
         */
        $date_last = '2021-03-22';

        if ($date_now_format < $date_last){
            return redirect('/participant/absent')->with('status', 'not-open-date')->with(compact('attend_time'));
        }

        if ($time_now < $attend_time){
            return redirect('/participant/absent')->with('status', 'not-open')->with(compact('attend_time'));
        }

        switch ($request->input('action')) {
            case 'absent':
                if ($time_now <= $late_time){
                    Attendance::create([
                        'participant_id' => $participant_check->id,
                        'ip_address' => $myIp,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'day' => $day,
                        'month' => $month,
                        'year' => $year,
                        'status' => 1,
                    ]);
                }
                else {
                    Attendance::create([
                        'participant_id' => $participant_check->id,
                        'ip_address' => $myIp,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'day' => $day,
                        'month' => $month,
                        'year' => $year,
                        'status' => 3,
                    ]);
                }
                return redirect('/participant/absent')->with('status', 'done');
                break;

            case 'izin':
                if ($time_now <= $late_time){
                    Attendance::create([
                        'participant_id' => $participant_check->id,
                        'ip_address' => $myIp,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'day' => $day,
                        'month' => $month,
                        'year' => $year,
                        'status' => 2,
                    ]);
                }
                else {
                    Attendance::create([
                        'participant_id' => $participant_check->id,
                        'ip_address' => $myIp,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'day' => $day,
                        'month' => $month,
                        'year' => $year,
                        'status' => 4,
                    ]);
                }
                return redirect('/participant/absent')->with('status', 'done');
                break;
        }
    }

    public function showParticipantDetail(){
        $id = Auth::user()->id;
        $participant = Participant::where('user_id', $id)->first();

        $date_now = Carbon::now();
        $month = $date_now->month;
        $year = $date_now->year;

        $attendances = Attendance::orderBy('day', 'ASC')->select('id', 'participant_id', 'day', 'month', 'year', 'status', 'last_status')->where('participant_id', $participant->id)->where('month', $month)->where('year', $year)->get()->toArray();
        $date_format = $year.'-'.$month.'-1';
        $date = new Carbon($date_format);

        $last_day = $date->endOfMonth()->format('d');
        $last_day = ltrim($last_day, '0');
        $attends_count = 0;
        $permits_count = 0;
        $lates_count = 0;
        $invalids_count = 0;
        $i = 1;
        while($i <= $last_day){
            if (array_search($i, array_column($attendances, 'day')) !== false){
                $key = array_search($i, array_column($attendances, 'day'));
                if ($attendances[$key]['status'] == 1) {
                    $attends_count += 1;
                } else if ($attendances[$key]['status'] == 2) {
                    $permits_count += 1;
                } else if ($attendances[$key]['status'] == 3 || $attendances[$key]['status'] == 4) {
                    $lates_count += 1;
                } else {
                    if ($attendances[$key]['last_status'] == 1) {
                        $attends_count += 1;
                    } else if ($attendances[$key]['last_status'] == 2) {
                        $permits_count += 1;
                    } else if ($attendances[$key]['last_status'] == 3 || $attendances[$key]['last_status'] == 4) {
                        $lates_count += 1;
                    } else {
                        $invalids_count += 1;
                    }
                }
            }
            $i++;
        }

        $target_month = $date->translatedFormat('F');
        $target_year = $year;

        return view('participant.calendar')->with(compact(['participant', 'last_day', 'attendances', 'attends_count', 'permits_count', 'lates_count', 'invalids_count', 'target_year', 'target_month']));
    }

    public function tes(Request $request){
        dd($request);
    }
}
