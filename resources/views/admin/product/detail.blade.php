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
                            Total Produk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $participant->products()->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-circle fa-2x text-primary"></i>
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
                </div>
                <div class="card-body">
                    {{-- <a href="{{ url('/admin/participant/create') }}" class="btn btn-primary mb-3">Tambah Peserta</a> --}}
                    <h3>{{ $participant->name }}</h3>
                    <h5>{{ $participant->nik }}</h5>
                    <div class="mt-5"></div>
                    {{-- <form action="{{ url ('/admin/product/'.$participant->nik) }}" method="post"
                        class="my-3 text-right">
                        @csrf
                        @method('put')
                        <button class="btn btn btn-success" type="submit">
                            <i class="fas fa-download"></i> Download All
                        </button>
                    </form> --}}
                    <div class="table table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:1px;">No</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                            @if ($participant->products->isNotEmpty())
                                @foreach ($participant->products as $product)
                                @php
                                    $i++;
                                @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category }}</td>
                                        <td class="text-center">
                                            {{-- <form action="{{ url ('/admin/product/'.$participant->nik.'/'.$product->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('patch')
                                                <button class="btn btn btn-primary" type="submit">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </form> --}}
                                            <form action="{{ url ('/admin/product/'.$participant->nik.'/'.$product->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn btn-danger" type="submit">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
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
