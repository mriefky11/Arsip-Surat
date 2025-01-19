@extends('layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 fw-bold">Daftar Pengguna</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NRP</th>
                                <th>Nama Lengkap</th>
                                <th>Pangkat</th>
                                <th>Staff</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
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
                                    <td>{{ $a->nrp }}</td>
                                    <td>{{ $a->nama }}</td>
                                    <td>{{ $a->pangkat }}</td>
                                    <td>{{ $a->staff }}</td>
                                    <td class="text-center">
                                        <a href="/dashboard/daftar_pengguna/{{ $a->id }}"
                                            class="btn btn-success btn-sm"><i class="fas fa-fw fa-eye"></i></a>

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
