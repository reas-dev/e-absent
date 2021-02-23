<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Attendance;
use App\Participant;

class AdminController extends Controller
{
    public function show(){
        $date_now = Carbon::now();

        $day = $date_now->day;
        $day = ltrim($day, '0');

        $month = $date_now->month;
        $year = $date_now->year;

        $attendances_count = Attendance::where('day', $day)->where('month', $month)->where('year', $year)->where('status', 1)->count();
        $permits_count = Attendance::where('day', $day)->where('month', $month)->where('year', $year)->where('status', 2)->count();
        $invalids_count = Attendance::where('day', $day)->where('month', $month)->where('year', $year)->where('status', 0)->count();

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

        // dd($participants);

        return view('admin.index')->with(compact(['participants', 'attendances_count', 'permits_count', 'invalids_count']));
    }
}
