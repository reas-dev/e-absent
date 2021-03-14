<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Report;
use App\Participant;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $userID = Auth::user()->id; // AMBIL USER ID (users->id)
        $parID = Participant::where('user_id', '=', $userID)->first(); // AMBIL DATA PARTICIPANT DARI USER TSB (TABEL RELASI)

        $target = $parID->id; // AMBIL ID DARI PARTICIPANT
        $reports = Report::where('participant_id', '=', $target)->orderBy('created_at', 'asc')->get(); // AMBIL REPORT YANG DIMILIKI PARTICIPANT TSB (PATOKAN participant_id)

        $reports = $reports->unique('month'); // HAPUS DUPLIKASI BERDASARKAN BULAN (APABILA PERNAH UPLOAD DI BULAN YANG SAMA > 1x)
        return view('participant.upload-laporan', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'file' => 'required|file|mimes:pdf|max:1000',
        ]);

        $id = Auth::user()->id;
        $participant = Participant::select(['code', 'id'])->where('user_id', $id)->first();

        // VALIDASI INPUT VALUE 'month'
        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $valid = false;
        for ($i = 0; $i < 12; $i++) {
            if ($request->month == $months[$i]) {
                $valid = true;
            }
        }
        if (!$valid) {
            return redirect('/home')->with('status', 'invalid-month');
        }

        $file = $request->file('file');
        $code = str_replace("/", "_", $participant->code);

        $month_target = $request->month;

        $date = Carbon::now(); // AMBIL TANGGAL SEKARANG
        $month = $date->addMonth()->format('F'); // AMBIL BULANNYA SAJA DLM FORMAT LETTER
        $year = $date->format('Y'); // AMBIL TAHUNNYA SAJA

        $nama_file = 'Laporan_' . $month_target . "_" . $year . "_" . $code . "." . $file->getClientOriginalExtension();
        $tujuan_upload = 'data_file/report/' . $code;

        $file->move($tujuan_upload, $nama_file);

        Report::create([
            'participant_id' => $participant->id,
            'file' => $nama_file,
            'month' => $month_target,
        ]);

        $parID = Participant::where('user_id', '=', $id)->first(); // AMBIL DATA PARTICIPANT DARI USER TSB (TABEL RELASI)
        $target = $parID->id; // AMBIL ID DARI PARTICIPANT
        $inputed = Report::where('participant_id', '=', $target)->where('month', '=', $request->month)->first();

        if ($inputed != NULL) {
            return redirect('/home')->with('status', 'report-done');
        } else {
            return redirect()->to('/route'); // REFRESH ??
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
