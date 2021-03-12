<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Attendance;
use App\TimeStatus;
use App\Participant;

class AdminController extends Controller
{
    public function show(){
        $date_now = Carbon::now();

        $day = $date_now->day;
        $day = ltrim($day, '0');

        $month = $date_now->month;
        $year = $date_now->year;

        $attendances = Attendance::where('day', $day)->where('month', $month)->where('year', $year)->get();

        $attendances_count = $attendances->whereIn('status', [1,3])->count();
        $permits_count = $attendances->whereIn('status', [2,4])->count();
        $lates_count = $attendances->whereIn('status', [3,4])->count();
        $invalids_count = $attendances->where('status', 0)->count();

        $participants = DB::table('participants')
        ->leftJoin('attendances', function ($join) {
            $date_now = Carbon::now();

            $day = $date_now->day;
            $day = ltrim($day, '0');

            $month = $date_now->month;
            $year = $date_now->year;

            $join->on('participants.id', '=', 'attendances.participant_id')
                 ->where('day', $day)
                 ->where('month', $month)
                 ->where('year', $year);
        })->get();

        $places = Participant::groupBy('place')->pluck('place');

        return view('admin.index')->with(compact(['participants', 'places', 'attendances_count', 'permits_count', 'lates_count', 'invalids_count','day','month','year']));
    }

    // Attend Time Settings
    public function showAttendTimeSet(){
        $time_status = TimeStatus::first();
        $hour = substr($time_status->attend, 0, 2);
        $minute = substr($time_status->attend, 3, 2);
        $second = substr($time_status->attend, -2);

        $places = Participant::groupBy('place')->pluck('place');

        return view('admin.setting.attend-time')->with(compact(['time_status', 'places', 'hour', 'minute', 'second']));
    }

    public function attendTimeSet(Request $request){
        $request->validate([
            'hour' => 'required|min:0|max:24',
            'minute' => 'required|min:0|max:59',
            'second' => 'required|min:0|max:59',
        ]);
        $hour = $request->hour;
        $minute = $request->minute;
        $second = $request->second;
        if ($hour < 10){
            $hour = '0'.$hour;
        }
        if ($minute < 10){
            $minute = '0'.$minute;
        }
        if ($second < 10){
            $second = '0'.$second;
        }
        $time = $hour.':'.$minute.':'.$second;
        $late_time = TimeStatus::first();
        $late_time->update([
            'attend' => $time,
        ]);
        return redirect('/admin/setting/attend-time');
    }

    // Late Time Settings
    public function showLateTimeSet(){
        $time_status = TimeStatus::first();
        $hour = substr($time_status->late, 0, 2);
        $minute = substr($time_status->late, 3, 2);
        $second = substr($time_status->late, -2);

        $places = Participant::groupBy('place')->pluck('place');

        return view('admin.setting.late-time')->with(compact(['time_status', 'places', 'hour', 'minute', 'second']));
    }

    public function lateTimeSet(Request $request){
        $request->validate([
            'hour' => 'required|min:0|max:24',
            'minute' => 'required|min:0|max:59',
            'second' => 'required|min:0|max:59',
        ]);
        $hour = $request->hour;
        $minute = $request->minute;
        $second = $request->second;
        if ($hour < 10){
            $hour = '0'.$hour;
        }
        if ($minute < 10){
            $minute = '0'.$minute;
        }
        if ($second < 10){
            $second = '0'.$second;
        }
        $time = $hour.':'.$minute.':'.$second;
        $late_time = TimeStatus::first();
        $late_time->update([
            'late' => $time,
        ]);
        return redirect('/admin/setting/late-time');
    }

    public function invalid($id){
        $attendance = Attendance::where('id', $id)->first();
        $attendance->update([
            'last_status' => $attendance->status,
            'status' => 0,
        ]);
        return redirect('/admin');
    }

    public function uninvalid($id){
        $attendance = Attendance::where('id', $id)->first();
        if($attendance->last_status == null){
            return redirect('/admin');
        }
        $attendance->update([
            'status' => $attendance->last_status,
            'last_status' => null,
        ]);
        return redirect('/admin');
    }

    public function showMapWithSamePlace($place){
        $date_now = Carbon::now();

        $day = $date_now->day;
        $day = ltrim($day, '0');

        $month = $date_now->month;
        $year = $date_now->year;

        $attendances = Attendance::where('day', $day)->where('month', $month)->where('year', $year)->get();

        $attendances_count = $attendances->whereIn('status', [1,3])->count();
        $permits_count = $attendances->whereIn('status', [2,4])->count();
        $lates_count = $attendances->whereIn('status', [3,4])->count();
        $invalids_count = $attendances->where('status', 0)->count();

        $participants = DB::table('participants')->select(['name', 'nik', 'latitude','longitude'])->where('place', $place)
        ->join('attendances', function ($join) {
            $date_now = Carbon::now();

            $day = $date_now->day;
            $day = ltrim($day, '0');

            $month = $date_now->month;
            $year = $date_now->year;

            $join->on('participants.id', '=', 'attendances.participant_id')
                 ->where('day', $day)
                 ->where('month', $month)
                 ->where('year', $year);
        })->get();

        $places = Participant::groupBy('place')->pluck('place');

        return view('admin.map-region')->with(compact(['participants', 'places']));
    }

    public function showAllAttend(){
        $date_now = Carbon::now()->format('Y-m-d');


        //--------------------------ganti tanggal mulai absen----------------------//
        $date_last = '2020-07-04';

        $participants = Participant::all();
        foreach ($participants as $participant) {
            $attendances = $participant->attendances;
            $participant->attend = 0;
            $participant->permit = 0;
            $participant->late = 0;
            $participant->invalid = 0;
            foreach ($attendances as $attendance) {
                if ($attendance->status == 1){
                    $participant->attend++;
                }
                else if ($attendance->status == 2){
                    $participant->permit++;
                }
                else if ($attendance->status == 3 || $attendance->status == 4){
                    $participant->late++;
                }
                else if ($attendance->status == 0){
                    $participant->invalid++;
                }
            }

        }

        $total_day = $this->getWorkdays($date_last, $date_now);

        $places = Participant::groupBy('place')->pluck('place');

        return view('admin.list-all')->with(compact(['total_day', 'participants', 'places']));
    }

    private function getWorkdays($date1, $date2, $workSat = FALSE, $patron = NULL) {
    if (!defined('SATURDAY')) define('SATURDAY', 6);
        if (!defined('SUNDAY')) define('SUNDAY', 0);

        //Array of all public festivities
        // $publicHolidays = array('01-01', '01-06', '04-25', '05-01', '06-02', '08-15', '11-01', '12-08', '12-25', '12-26');
        $publicHolidays = array();
        // The Patron day (if any) is added to public festivities
        if ($patron) {
          $publicHolidays[] = $patron;
        }

        /*
         * Array of all Easter Mondays in the given interval
         */
        $yearStart = date('Y', strtotime($date1));
        $yearEnd   = date('Y', strtotime($date2));

        for ($i = $yearStart; $i <= $yearEnd; $i++) {
          $easter = date('Y-m-d', easter_date($i));
          list($y, $m, $g) = explode("-", $easter);
          $monday = mktime(0,0,0, date($m), date($g)+1, date($y));
          $easterMondays[] = $monday;
        }

        $start = strtotime($date1);
        $end   = strtotime($date2);
        $workdays = 0;
        for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
          $day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
          $mmgg = date('m-d', $i);
          if ($day != SUNDAY &&
            !in_array($mmgg, $publicHolidays) &&
            !in_array($i, $easterMondays) &&
            !($day == SATURDAY && $workSat == FALSE)) {
              $workdays++;
          }
        }

        return intval($workdays);
      }

      public function showAdminParticipantDetail($month, $year, $nik){
        $participant = Participant::where('nik', $nik)->firstOrFail();
        $attendances = Attendance::orderBy('day', 'ASC')->select('id', 'participant_id', 'day', 'month', 'year', 'status')->where('participant_id', $participant->id)->where('month', $month)->where('year', $year)->get()->toArray();
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
                    $invalids_count += 1;
                }
            }
            $i++;
        }

        $target_month = $date->translatedFormat('F');
        $target_year = $year;

        // dd($attendances);
        return view('admin.calendar')->with(compact(['participant', 'last_day', 'attendances', 'attends_count', 'permits_count', 'lates_count', 'invalids_count', 'target_year', 'target_month']));
    }
}
