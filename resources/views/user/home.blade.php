<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/user_home.css') }}" />

<title>User Home</title>

<div class="row h-100">
    <div class="col my-auto mx-auto">
        <div class="registration-form">
        <form method="POST">
        @csrf
            <div class="form-icon">
                <img src="{{ asset('img/logo_pkkp.png') }}" width="80" height="80">
            </div>
            <p class="text-xl-center font-weight-bold" style="font-size:30px">ABSENSI PKKP</p>
            <div class="form-group">
                <input type="text" class="form-control item @error('nik') is-invalid @enderror "id="nik" placeholder="NIK" required>
                @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group"><div class="col text-center mt-2">
                <button type="submit" class="btn hadir">Hadir</button>
                <button type="submit" class="btn izin">Izin</button>
            </div></div>
        </form>
    </div>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>