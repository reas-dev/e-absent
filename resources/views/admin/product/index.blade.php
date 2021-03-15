@extends('layouts.admin')
@section('title')
    Absensi Harian
@endsection
@section('customStyle')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container-fluid">
    <!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Peserta</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $participants->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-circle fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Produk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $participants->hasProduct }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Belum Ada Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $participants->count() - $participants->hasProduct }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Peserta</h6>
                </div>
                <div class="card-body">
                    {{-- <a href="{{ url('/admin/participant/create') }}" class="btn btn-primary mb-3">Tambah Peserta</a> --}}
                    <div class="table table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:1px;">No</th>
                                    <th>Nama (NIK)</th>
                                    <th>Kode</th>
                                    <th>Nama Produk</th>
                                    <th>URL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                            @if ($participants->isNotEmpty())
                                @foreach ($participants as $participant)
                                @php
                                    $i++;
                                @endphp
                                    @if ($participant->product != null)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <div>{{ $participant->name }}</div>
                                            <div>{{ $participant->nik }}</div>
                                        </td>
                                        <td>{{ $participant->code }}</td>
                                        <td>{{ $participant->product->name }}</td>
                                        <td>{{ $participant->product->url }}</td>
                                    </tr>
                                    @else
                                    <tr style="background-color: #f77e88; color: black;">
                                        <td>{{ $i }}</td>
                                        <td>
                                            <div>{{ $participant->name }}</div>
                                            <div>{{ $participant->nik }}</div>
                                        </td>
                                        <td>{{ $participant->code }}</td>
                                        <td colspan='2' class="text-center">Belum ada produk</td>
                                    </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr><td align='center' colspan='4'>Data Tidak Ada</td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable();
        } );
    </script>
@endsection
