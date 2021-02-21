<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\Attendance;
use Carbon\Carbon;

class ParticipantController extends Controller
{
    public function showAbsent(){
        return view('participant.nik');
    }

    public function absent(Request $request){
        $participant_check = Participant::where('nik', $request->nik)->first();
        if($participant_check == null){
            return redirect('/absent')->with('status', 'nik-not-found');
        }

        $date_now = Carbon::now();

        $day = $date_now->day;
        $day = ltrim($day, '0');

        $month = $date_now->month;
        $year = $date_now->year;

        // $last_day = $date_now->endOfMonth()->format('d');
        // $last_day = ltrim($last_day, '0');

        $attendance_check = Attendance::where('participant_id', $participant_check->id)->where('day', $day)->where('month', $month)->where('year', $year)->first();
        if($attendance_check != null){
            return redirect('/absent')->with('status', 'have-attend');
        }

        $request->validate([
            'nik' => 'required|size:16',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        Attendance::create([
            'participant_id' => $participant_check->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'status' => 0,
        ]);

        return redirect('/absent')->with('status', 'done');
    }
}
