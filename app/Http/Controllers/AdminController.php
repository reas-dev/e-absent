<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\Attendance;
use App\TimeStatus;
use App\Participant;
use App\Report;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Auth;

use ZipArchive;
use Madnest\Madzipper\Madzipper;

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function show(){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
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

        return view('admin.absent.index')->with(compact(['participants', 'places', 'attendances_count', 'permits_count', 'lates_count', 'invalids_count','day','month','year']));
    }

    // Attend Time Settings
    public function showAttendTimeSet(){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $time_status = TimeStatus::first();
        $hour = substr($time_status->attend, 0, 2);
        $minute = substr($time_status->attend, 3, 2);
        $second = substr($time_status->attend, -2);

        $places = Participant::groupBy('place')->pluck('place');

        return view('admin.setting.attend-time')->with(compact(['time_status', 'places', 'hour', 'minute', 'second']));
    }

    public function attendTimeSet(Request $request){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
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
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $time_status = TimeStatus::first();
        $hour = substr($time_status->late, 0, 2);
        $minute = substr($time_status->late, 3, 2);
        $second = substr($time_status->late, -2);

        $places = Participant::groupBy('place')->pluck('place');

        return view('admin.setting.late-time')->with(compact(['time_status', 'places', 'hour', 'minute', 'second']));
    }

    public function lateTimeSet(Request $request){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
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
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $attendance = Attendance::where('id', $id)->first();
        $attendance->update([
            'last_status' => $attendance->status,
            'status' => 0,
        ]);
        return redirect('/admin/daily');
    }

    public function uninvalid($id){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $attendance = Attendance::where('id', $id)->first();
        if($attendance->last_status == null){
            return redirect('/admin');
        }
        $attendance->update([
            'status' => $attendance->last_status,
            'last_status' => null,
        ]);
        return redirect('/admin/daily');
    }

    public function showMapWithSamePlace($place){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
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

        return view('admin.absent.map-region')->with(compact(['participants', 'places']));
    }

    public function showAllAttend(){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $date_now = Carbon::now()->format('Y-m-d');


        /**
            NEED CHANGE ATTENDANCE START DATE
         */
        $date_last = '2021-03-22';

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

        return view('admin.absent.total')->with(compact(['total_day', 'participants', 'places']));
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
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
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

        return view('admin.absent.calendar')->with(compact(['participant', 'last_day', 'attendances', 'attends_count', 'permits_count', 'lates_count', 'invalids_count', 'target_year', 'target_month']));
    }

    public function showList(){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $participants = Participant::with('user')->get();

        return view('admin.index')->with(compact(['participants']));
    }

    public function showProduct(){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $participants = Participant::with('user')->with('products')->get();
        $i = 0;
        foreach ($participants as $participant) {
            if ($products_count = $participant->products()->count() != null) {
                $i += 1;
            }
        }

        $participants->hasProduct = $i;

        return view('admin.product.index')->with(compact(['participants']));

    }

    public function showReport(){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $participants = Participant::with('user')->with('reports')->get();
        $i = 0;
        foreach ($participants as $participant) {
            if ($reports_count = $participant->reports()->count() != null) {
                $i += 1;
            }
        }

        $participants->hasReport = $i;

        return view('admin.report.index')->with(compact(['participants']));
    }

    public function showReportDetail($nik){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $participant = Participant::with('user')->with('reports')->where('nik', $nik)->first();

        return view('admin.report.detail')->with(compact(['participant']));
    }

    public function showProductDetail($nik){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $participant = Participant::with('user')->with('products')->where('nik', $nik)->first();

        return view('admin.product.detail')->with(compact(['participant']));
    }

    public function reportDownload($nik, $id){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $participant = Participant::select(['id','code'])->where('nik', $nik)->first();
        $report = Report::where('participant_id', $participant->id)->where('id', $id)->first();
        if ($report == null){
            return redirect()->back();
        }

        /**
            NEED CHANGE TO STORAGE LINK
         */
        $code = str_replace("/", "_", $participant->code);
        $tujuan_download = 'data_file/report/'.$code;
        $file = public_path().'/'.$tujuan_download.'/'.$report->file;
        $headers = array('Content-Type: application/pdf',);
        return Response::download($file, $report->file, $headers);
    }

    public function reportDownloadAllOnePerson($nik){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $participant = Participant::select(['id','code'])->where('nik', $nik)->first();
        if($participant->reports->isEmpty()){
            return redirect('/admin/report/'.$nik);
        }
        $code = str_replace("/", "_", $participant->code);
        $tujuan_download = 'data_file/report/'.$code;
        $tujuan = public_path().'/'.$tujuan_download;

        /**
            NEED CHANGE TO STORAGE LINK
         */
        $files = glob($tujuan.'/*');
        $zip = new Madzipper;
        $zip->make(public_path($code.'.zip'))->add($files)->close();

        return response::download(public_path($code.'.zip'));
    }

    public function reportDownloadAll(){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $tujuan_download = 'data_file/report/';
        $tujuan = public_path().'/'.$tujuan_download;

        /**
            NEED CHANGE TO STORAGE LINK
         */
        $files = glob($tujuan.'/*');
        $zip = new Madzipper;
        $zip->make(public_path('laporan pkkp 2021.zip'))->add($files)->close();

        return response::download(public_path('laporan pkkp 2021.zip'));
    }

    //destroy
    function reportDelete($nik, $id){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $participant = Participant::select(['id','code'])->where('nik', $nik)->first();
        $report = Report::where('participant_id', $participant->id)->where('id', $id)->first();
        if ($report == null){
            return redirect()->back();
        }

        Report::destroy($report->id);
        return redirect()->back()->with('status', 'Data Berhasil Dihapus');
    }

    //destroy
    function productDelete($nik, $id){
        /** @var App\User $Auth */
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Anda tidak memiliki akses');
        }
        $participant = Participant::select(['id','code'])->where('nik', $nik)->first();
        $product = Product::where('participant_id', $participant->id)->where('id', $id)->first();
        if ($product == null){
            return redirect()->back();
        }

        Product::destroy($product->id);
        return redirect()->back()->with('status', 'Data Berhasil Dihapus');
    }

    public function exportExcel(){
        return Excel::download(new ReportExport, 'Laporan_bulanan.xlsx');
    }
}
