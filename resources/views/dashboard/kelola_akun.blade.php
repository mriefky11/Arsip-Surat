@extends('layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 fw-bold">Kelola Akun</h1>

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="/dashboard/kelola_akun/create" class=" btn btn-success rounded-pill shadow-sm"><i
                        class="fas fa-add fa-sm text-white-50"></i> Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                {{-- <th>Foto</th> --}}
                                <th>NRP</th>
                                <th>Nama Lengkap</th>
                                <th>Pangkat</th>
                                <th>Staff</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                {{-- <th>Foto</th> --}}
                                <th>NRP</th>
                                <th>Nama Lengkap</th>
                                <th>Pangkat</th>
                                <th>Staff</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($User as $a)
                                <tr>
                                    {{-- <td></td> --}}
                                    <td>{{ $a->nrp }}</td>
                                    <td>{{ $a->nama }}</td>
                                    <td>{{ $a->pangkat }}</td>
                                    <td>{{ $a->staff }}</td>
                                    <td class="text-center">
                                        <a href="/dashboard/kelola_akun/{{ $a->id }}"
                                            class="btn btn-success btn-sm"><i class="fas fa-fw fa-eye"></i></a>
                                        <a href="/dashboard/kelola_akun/{{ $a->id }}/edit"
                                            class="btn btn-warning btn-sm"><i class="fas fa-fw fa-pen"></i></a>
                                        <form action="/dashboard/kelola_akun/{{ $a->id }}" method="post"
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
