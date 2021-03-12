<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/user_login.css') }}" />

    <title>Kalender Absensi Bulanan</title>
</head>
<body>
<div class="container white">
    <div class="row">
        {{-- <div class="col-md-1">
            <img src="{{ asset('img/logo_pkkp.png') }}" alt="Logo PKKP" height="90" width="90" >
        </div> --}}
        <div class="col">
            <img src="{{ asset('img/logo_pkkp.png') }}" alt="Logo PKKP" height="90" width="90" >
            <h1 class="text-center">KALENDER ABSENSI</h1>
        </div>
    </div>

    <div class="container-top">
        <div class="row p-4">
            <div class="col px-4">
                <p>Nama : </p>
                <p class="text-wrap">{{ $participant->name }}</p>
            </div>
            <div class="col mt-5 px-4">
                <p>NIK     : </p>
                <p class="text-wrap">{{ $participant->nik }}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h2 class="text-center">{{ $target_month }} {{ $target_year }}</h2>
        </div>
    </div>


    <div class="p-4 container-top">
        <div class="row seven-cols">
            @php
                $i = 1;
            @endphp
            @while ($i <= $last_day)
                @php
                    if (array_search($i, array_column($attendances, 'day')) !== false){
                    $key = array_search($i, array_column($attendances, 'day'));
                        if ($attendances[$key]['status'] == 1) {
                            @endphp
                                <div class="col-md-1 col-3 p-2">
                                    <div class="rounded-circle rounded-circle-blue">{{ $i }}</div>
                                    <div class="text-center">HADIR</div>
                                </div>
                            @php
                        } else if ($attendances[$key]['status'] == 2) {
                            @endphp
                                <div class="col-md-1 col-3 p-2">
                                    <div class="rounded-circle rounded-circle-yellow">{{ $i }}</div>
                                    <div class="text-center">IZIN</div>
                                </div>
                            @php
                        } else if ($attendances[$key]['status'] == 3 || $attendances[$key]['status'] == 4) {
                            @endphp
                                <div class="col-md-1 col-3 p-2">
                                    <div class="rounded-circle rounded-circle-red">{{ $i }}</div>
                                    <div class="text-center">TERLAMBAT</div>
                                </div>
                            @php
                        } else {
                            if ($attendances[$key]['last_status'] == 1) {
                                @endphp
                                    <div class="col-md-1 col-3 p-2">
                                        <div class="rounded-circle rounded-circle-blue">{{ $i }}</div>
                                        <div class="text-center">HADIR</div>
                                    </div>
                                @php
                            } else if ($attendances[$key]['last_status'] == 2) {
                                @endphp
                                    <div class="col-md-1 col-3 p-2">
                                        <div class="rounded-circle rounded-circle-yellow">{{ $i }}</div>
                                        <div class="text-center">IZIN</div>
                                    </div>
                                @php
                            } else if ($attendances[$key]['last_status'] == 3 || $attendances[$key]['last_status'] == 4) {
                                @endphp
                                    <div class="col-md-1 col-3 p-2">
                                        <div class="rounded-circle rounded-circle-red">{{ $i }}</div>
                                        <div class="text-center">TERLAMBAT</div>
                                    </div>
                                @php
                            } else {
                                @endphp
                                    <div class="col-md-1 col-3 p-2">
                                        <div class="rounded-circle rounded-circle-grey">{{ $i }}</div>
                                        <div class="text-center">TIDAK ABSEN</div>
                                    </div>
                                @php
                            }
                        }
                    }
                    else {

                    @endphp
                    <div class="col-md-1 col-3 p-2">
                        <div class="rounded-circle rounded-circle-grey">{{ $i }}</div>
                        <div class="text-center">BELUM ABSEN</div>
                    </div>
                    @php
                    }
                $i++;
                @endphp
            @endwhile
        </div>
    </div>

    <div class="container-top mt-5">
        <div class="row p-4">
            <div class="col px-4 mt-5">
                <p>Hadir           : </p>
                <p class="text-wrap">{{ $attends_count }}</p>
            </div>
            <div class="col px-4">
                <p>Izin              : </p>
                <p class="text-wrap">{{ $permits_count }}</p>
            </div>
            <div class="col px-4 mt-5">
                <p>Terlambat    : </p>
                <p class="text-wrap">{{ $lates_count }}</p>
            </div>
            <div class="col px-4 mt-5">
                <p>Tidak Hadir : </p>
                <p class="text-wrap">{{ $invalids_count }}</p>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</body>
</html>
