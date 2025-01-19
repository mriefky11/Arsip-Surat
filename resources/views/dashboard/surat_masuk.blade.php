@extends('layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 fw-bold">Surat Masuk</h1>

        @if (session()->has('success'))
            <div class="alert alert-success justify-content-end" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                @if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'riskowner')
                    <a href="/dashboard/surat_masuk/create" class="btn btn-success rounded-pill shadow-sm"><i
                            class="fas fa-add fa-sm text-white-50"></i>Tambah Surat</a>
                @endif
                <!-- Form Filter -->
                <form action="{{ url()->current() }}" method="get">
                    <div class="row g-3 mr-2">
                        <div class="col-8">
                            <select name="category_id" class="form-select shadow-sm">
                                @foreach ($category as $c)
                                    <option value="{{ $c->id }}">{{ $c->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-success shadow-sm rounded-pill">Filter</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nomor Surat</th>
                                <th>Kategori</th>
                                <th>Pengirim</th>
                                <th>Tebusan</th>
                                <th>Perihal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nomor Surat</th>
                                <th>Kategori</th>
                                <th>Pengirim</th>
                                <th>Tebusan</th>
                                <th>Perihal</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($suratMasuk as $sk)
                                <tr>
                                    <td>{{ $sk->created_at }}</td>
                                    <td>{{ $sk->nomor_surat }}</td>
                                    <td>
                                        {{ $sk->category->category }}
                                    </td>
                                    <td>{{ $sk->pengirim }}</td>
                                    <td>{{ $sk->tembusan }}</td>
                                    <td>{{ $sk->perihal_limited }}</td>
                                    <td class="text-center">
                                        <a href="/dashboard/surat_masuk/{{ $sk->id }}"
                                            class="btn btn-success btn-sm mb-1"><i class="fas fa-fw fa-eye "></i>
                                        </a>
                                        @if (Auth::user()->role === 'admin')
                                            <a href="/dashboard/surat_masuk/{{ $sk->id }}/edit"
                                                class="btn btn-warning btn-sm mb-1"><i class="fas fa-fw fa-pen"></i></a>
                                        @endif
                                        <form action="/dashboard/surat_masuk/{{ $sk->id }}" method="post"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin menghapus email ini?')"><i
                                                    class="fas fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
