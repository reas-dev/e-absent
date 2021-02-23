@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Absen Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $attendances_count }}/{{ $participants->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Izin Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $permits_count }}/{{ $participants->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-info-circle fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Terlambat Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $participants->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Belum Absen Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($participants->count()-($permits_count+$attendances_count)) }}/{{ $participants->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times-circle fa-2x text-secondary"></i>
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Pemilih</h6>
                </div>
                <div class="card-body">
                    {{-- <a href="{{ url('/admin/participant/create') }}" class="btn btn-primary mb-3">Tambah Peserta</a> --}}
                    <div class="table table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama (NIK)</th>
                                    <th>Status</th>
                                    <th style="width:1px; white-space:nowrap;">Action Button</th>
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
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <div>{{ $participant->name }}</div>
                                            <div>{{ $participant->nik }}</div>
                                        </td>
                                        @if ($participant->status == null)
                                            <td><p class="badge badge-secondary">belum absen hari ini</p></td>
                                        @elseif ($participant->status == 1)
                                            <td><p class="badge badge-success">sudah absen hari ini</p></td>
                                        @elseif ($participant->status == 2)
                                            <td><p class="badge badge-warning">izin hari ini</p></td>
                                        @elseif ($participant->status == 3)
                                            <td><p class="badge badge-danger">absen ditolak hari ini</p></td>
                                        @endif
                                        <td></td>
                                    </tr>
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
