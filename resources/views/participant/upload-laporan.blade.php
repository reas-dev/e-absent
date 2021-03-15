@extends('layouts.participant')
@section('title')
Upload Laporan
@endsection

@section('customStyle')
<link rel="stylesheet" type="text/css" href="{{ asset('css/user_home.css') }}" />
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous"> -->
@endsection

@section('content')
<div class="row h-100 mx-auto">
    <div class="col my-auto h-100">
        <div class="registration-form my-auto">
            <form method="POST" action="{{ url('/participant/report') }}" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-icon">
                    <img src="{{ asset('img/logo_pkkp.png') }}" width="80" height="80">
                </div>
                <h3 class="text-center font-weight-bold my-4">UPLOAD LAPORAN PKKP 2021</h3>

                <div class="form-group">
                    <select class="form-control item @error('month') is-invalid @enderror" id="month" name="month" required>
                        <option selected disabled class="bg-secondary text-white">Laporan untuk bulan...</option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                    </select>
                    @error('month')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="file" required />
                        <label class="custom-file-label item" for="file">Pilih file laporan</label>
                    </div>
                    @error('file')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="row mt-3">
                        <div class="col text-center">
                            <button type="submit" class="btn hadir">Upload</button>
                            <a href="{{ url('/home') }}" class="btn hadir bg-secondary">Kembali</a>
                        </div>
                    </div>
                </div>

                {{-- <div class="text-center mt-3">
                <a class="" href="{{ url('/register') }}">Don't have account?</a>
        </div> --}}
        </form>
        <form class="mt-2">
            <h4>Laporan Tersimpan :</h4>
            <ul>
                @foreach($reports as $report)
                <li>{{ $report->month }}</li>
                @endforeach
            </ul>
        </form>
    </div>
</div>
</div>
@endsection

@section('script')
    @if (Session::has('status') && Session::get('status') == 'has-report')
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Ups!',
                text: 'Laporan bulan tersebut sudah terunggah.',
                showConfirmButton: false,
                timer: 1200
            })
        </script>
    @elseif (Session::has('status') && Session::get('status') == 'invalid-month')
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Ups!',
                text: 'Bulan tidak ditemukan.',
                showConfirmButton: false,
                timer: 1200
            })
        </script>
    @endif
<script>
    // FUNGSI TAMPILKAN NAMA FILE SETELAH PILIH FILE
    $('#file').on('change', function() {
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
@endsection
