@extends('layouts.main')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 fw-bold">Disposisi Surat</h1>

        @if (session()->has('success'))
            <div class="alert alert-success justify-content-end" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <a href="/dashboard/surat_keluar/create" class=" btn btn-success rounded-pill shadow-sm"><i
                        class="fas fa-add fa-sm text-white-50"></i>Kirim Surat</a>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal Diterima</th>
                                <th>Nomor Surat</th>
                                <th>Pengirim</th>
                                <th>Diterima Oleh</th>
                                <th>Isi Disposisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tanggal Diterima</th>
                                <th>Nomor Surat</th>
                                <th>Pengirim</th>
                                <th>Diterima Oleh</th>
                                <th>Isi Disposisi</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($disposisi as $sk)
                                <tr>
                                    <td>{{ $sk->tanggal_diterima }}</td>
                                    <td>{{ $sk->nomor_surat }}</td>
                                    <td>{{ $sk->pengirim }}</td>
                                    <td>{{ $sk->diterima_oleh }}</td>
                                    <td>{{ $sk->isi_disposisi }}</td>
                                    <td class="text-center">
                                        <a href="/dashboard/disposisi/{{ $sk->id }}"
                                            class="btn btn-success btn-sm "><i class="fas fa-fw fa-eye "></i>
                                        </a>
                                        {{-- <a href="/dashboard/disposisi/{{ $sk->id }}/edit"
                                            class="btn btn-warning btn-sm"><i class="fas fa-fw fa-pen"></i></a> --}}
                                        <form action="/dashboard/disposisi/{{ $sk->id }}" method="post"
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
