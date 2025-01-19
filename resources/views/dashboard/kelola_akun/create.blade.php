@extends('layouts.main')

@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800 fw-bold">Tambah Akun</h1>

        {{-- form control --}}
        <div class="card shadow mb-4 py-5 px-3">
            <form action="/dashboard/kelola_akun" method="POST" class="px-4" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nrp" class="form-label">NRP</label>
                    <input type="number" class="form-control form-control-sm @error('nrp') is-invalid @enderror"
                        name="nrp" id="nrp" placeholder="" autofocus value="{{ old('nrp') }}">
                    @error('nrp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select form-select-sm">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror"
                        name="nama" id="nama" placeholder="" autofocus value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="pangkat">Pangkat</label>
                    <input type="text" class="form-control form-control-sm @error('pangkat') is-invalid @enderror"
                        name="pangkat" id="pangkat" placeholder="" autofocus value="{{ old('pangkat') }}">
                    @error('pangkat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="staff">Staff</label>
                    <input type="text" class="form-control form-control-sm @error('staff') is-invalid @enderror"
                        id="staff" name="staff" autofocus value="{{ old('staff') }}">
                    @error('staff')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror"
                        name="username" id="username" placeholder="" autofocus value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                        name="password" id="password" placeholder="">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto"
                        id="foto">
                    @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 d-flex">
                    <input type="submit" class="btn btn-success rounded-pill shadow-sm col-xl-2" value="Tambah">
                </div>
            </form>
        </div>
    </div>
@endsection
