<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">

    <title>Kartu Identitas</title>
  </head>
  <body>
    {{-- head --}}
    <div class="bg-wave-head">
        <div class="row container-fluid pb-5">
            <div class="col-2">
            <img src="{{ asset('img/logo_pkkp.png') }}" alt="" class="img-fluid">
            </div>
            <div class="col-8 pt-5 pb-5 text-center">
                <h5><b>PEMERINTAH PROVINSI JAWA TENGAH</b></h3>
                <h5><b>DINAS KEPEMUDAAN, OLAHRAGA DAN PARIWISATA</b></h3>
                <h6>Jl. Ki Mangunsarkoro No.12 Semarang 50241</h6>
                <h6>Telp. 024-8419956 Fax. 024-8419959</h6>
                <h6>Website: https://pkkpjateng.com</h6>
            </div>
            <div class="col-2">
            <img src="{{ asset('img/logo_pkkp.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>

    {{-- content --}}
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/logo_pkkp.png') }}" alt="" class="bg-wave-photo my-3" style="width: 3cm; height: 4cm;">
            </div>
        </div>
        <div class="row">
            <div class="col d-flex align-items-center justify-content-center">
                <h6 class="bg-nametag">ANDREAS YULIANTO</h6>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-3">
                Kabupaten Asal
            </div>
            <div class="col-1 text-center">:</div>
            <div class="col-4">Semarang</div>
        </div>
        <div class="row justify-content-center">
            <div class="col-3">
                Kabupaten Penugasan
            </div>
            <div class="col-1 text-center">:</div>
            <div class="col-4">Pemalang</div>
        </div>
        <div class="row justify-content-center">
            <div class="col-3">
                Alamat
            </div>
            <div class="col-1 text-center">:</div>
            <div class="col-4">Jl. Ki Mangunsarkoro No. 12 Semarang</div>
        </div>
        <div class="row justify-content-center">
            <div class="col-3">
                Universitas
            </div>
            <div class="col-1 text-center">:</div>
            <div class="col-4">Universitas Dian Nuswantoro</div>
        </div>
    </div>

    {{-- foot --}}
    <div class="bg-wave-foot container-fluid min-vh-40">
        <div class="row">
            <div class="col d-flex align-items-center justify-content-center">
                <h6 class="bg-ipk-text">IPK</h6>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex align-items-center justify-content-center">
                <h3 class="bg-ipk">3.6</h3>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
