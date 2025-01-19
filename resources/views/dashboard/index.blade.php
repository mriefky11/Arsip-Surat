@extends('layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Dashboard</h1>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="/dashboard/surat_masuk" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-m font-weight-bold text-success text-uppercase mb-1">
                                        Surat Masuk</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahSuratMasuk }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-envelope fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="/dashboard/surat_keluar" class="text-decoration-none">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-m font-weight-bold text-primary text-uppercase mb-1">
                                        Surat Keluar</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahSuratKeluar }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="/dashboard/disposisi" class="text-decoration-none">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-m font-weight-bold text-info text-uppercase mb-1">
                                        Disposisi Surat</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahDisposisi }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-reply fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="/dashboard/daftar_pengguna" class="text-decoration-none">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-m font-weight-bold text-warning text-uppercase mb-1">
                                        Total Pengguna</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pengguna }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
