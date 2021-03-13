<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/user_login.css') }}" />

<link rel="stylesheet" type="text/css" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css" />

<title>User Login</title>

<div class="row h-100">
    <div class="col my-auto mx-auto white">

    <img src="{{ asset('img/disporapar_logo.png') }}" alt="Logo Disporapar" height="80" width="80" style="float: left;">
        <img src="{{ asset('img/pkkp_logo.png') }}" alt="Logo PKKP" height="90" width="90" style="float: right;">

    <div class="row h2-header">
        <h2 class="h2-headercenter">KALENDER ABSENSI</h2>
    </div>

    <div class="mt-4">
        <div class="container container-top">
            <div class="row" style="padding-top: 5px; padding-left: 15px;">
                <h3 style="display:inline-block; width: 80px;">Nama : </h3>
                <h3>Isi Variable Dinamis</h3>
            </div>
            <div class="row" style="padding-left: 15px;">
                <h3 style="display:inline-block; width: 80px;">NIK     : </h3>
                <h3>Isi Variable Dinamis</h3>
            </div>
        </div>
    </div>

<!--<div data-provide="calendar"></div>-->

<div class="row h2-top">
    <h2 class="h2-topleft">April</h2>
    <h2 class="h2-topright">2021</h2>
</div>

<div class="container container-calendar mt-4">
    <div class="row">
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">1</div>
            <p>HADIR</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-blue">2</div>
            <p>HADIR</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-red">3</div>
            <p>HADIR</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-yellow">4</div>
            <p>HADIR</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">5</div>
            <p>HADIR</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">6</div>
            <p>HADIR</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">7</div>
            <p>HADIR</p>
        </div>
    </div>
    <div class="row">
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">8</div>
            <p>IZIN</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">9</div>
            <p>IZIN</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">10</div>
            <p>IZIN</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">11</div>
            <p>IZIN</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">12</div>
            <p>IZIN</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">13</div>
            <p>IZIN</p>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">14</div>
            <p>IZIN</p>
        </div>
    </div>
    <div class="row">
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">15</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">16</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">17</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">18</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">19</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">20</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">21</div>
        </div>
    </div>
    <div class="row">
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">22</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">23</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">24</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">25</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">26</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">27</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">28</div>
        </div>
    </div>
    <div class="row">
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">29</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">30</div>
        </div>
        <div class="col col-calendar">
            <div class="rounded-circle rounded-circle-grey">31</div>
        </div>
        <div class="col col-calendar">
        </div>
        <div class="col col-calendar">
        </div>
        <div class="col col-calendar">
        </div>
        <div class="col col-calendar">
        </div>
    </div>
</div>

<div class="mt-5">
    <div class="container container-top">
        <div class="row" style="padding-top: 5px; padding-left: 15px;">
            <h3 style="display:inline-block; width: 120px;">Izin           : </h3>
            <h3>Isi Variable Dinamis</h3>
        </div>
        <div class="row" style="padding-left: 15px;">
            <h3 style="display:inline-block; width: 120px;">Hadir        : </h3>
            <h3>Isi Variable Dinamis</h3>
        </div>
        <div class="row" style="padding-left: 15px;">
            <h3 style="display:inline-block; width: 120px;">Terlambat : </h3>
            <h3>Isi Variable Dinamis</h3>
        </div>
    </div>
</div>

</div>
</div>

<script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
