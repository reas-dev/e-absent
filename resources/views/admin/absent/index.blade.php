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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $lates_count }}/{{ $participants->count() }}</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($participants->count()-($permits_count+$attendances_count)-$invalids_count) }}/{{ $participants->count() }}</div>
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
                                    <th>Kab. Penugasan</th>
                                    <th>Status</th>
                                    <th class="text-center">Action Button</th>
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
                                            <a href="{{ url('admin/detail/'.$month.'/'.$year.'/'.$participant->nik) }}" class="text-muted"><div>{{ $participant->name }}</div>
                                                <div>{{ $participant->nik }}</div></a>
                                        </td>
                                        <td>{{ $participant->code }}</td>
                                        <td>{{ $participant->place }}</td>
                                        @if ($participant->status == 0 && !is_null($participant->status))
                                            <td><p class="badge badge-danger">invalid absen</p></td>
                                        @elseif ($participant->status == 1)
                                            <td><p class="badge badge-success">sudah absen hari ini</p></td>
                                        @elseif ($participant->status == 2)
                                            <td><p class="badge badge-warning">izin hari ini</p></td>
                                        @elseif ($participant->status == 3)
                                            <td><p class="badge badge-danger">absen terlambat hari ini</p></td>
                                        @elseif ($participant->status == 4)
                                            <td><p class="badge badge-danger">izin terlambat hari ini</p></td>
                                        @elseif (is_null($participant->status))
                                        <td><p class="badge badge-secondary">belum absen hari ini</p></td>
                                        @endif
                                        <td class="text-center">
                                            @if ($participant->id != null)
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                                    <i class="fas fa-map-marker"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">My Location</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <iframe src="https://maps.google.com/maps?q={{ $participant->latitude }}, {{ $participant->longitude }}&z=15&output=embed" width="360" height="270" frameborder="0" style="border:0"></iframe>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                @if ($participant->status == 0 && !is_null($participant->status))
                                                    <form action="{{ url ('admin/setting/uninvalid/' . $participant->id) }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('post')
                                                        <button class="btn btn btn-warning" type="submit">
                                                            <i class="fas fa-undo"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ url ('admin/setting/invalid/' . $participant->id) }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('post')
                                                        <button class="btn btn btn-danger" type="submit">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
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

@section('script')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable();
        } );
    </script>
@endsection
