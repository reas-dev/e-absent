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
        return view('participant.upload-laporan');
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
            'file' => 'required|file|mimes:doc,docx,pdf|max:308',
        ]);

        $id = Auth::user()->id;
        $participant = Participant::select(['code', 'id'])->where('user_id', $id)->first();

        $file = $request->file('file');
        $code = str_replace("/", "_", $participant->code);

        $date = Carbon::now(); // AMBIL TANGGAL SEKARANG
        $month = $date->format('F'); // AMBIL BULANNYA SAJA DLM FORMAT LETTER
        $year = $date->format('Y'); // AMBIL TAHUNNYA SAJA

        $nama_file = 'laporan_' . $month . "_" . $year . "_" . $code . "." . $file->getClientOriginalExtension();
        $tujuan_upload = 'data_file/report/' . $code;

        $file->move($tujuan_upload, $nama_file);

        Report::create([
            'participant_id' => $participant->id,
            'file' => $file
        ]);

        return redirect('/home')->with('status', 'report-done');
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
