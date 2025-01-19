@extends('layouts.main')

@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->

        {{-- form control --}}
        <div class="card shadow mb-4 py-5 px-3">
            <h1 class="h3 mb-4 text-gray-800 fw-bold text-center">Profile</h1>
            <div class="mx-auto d-block">
                <img src="{{ asset('storage/' . $User->foto) }}" class="rounded" width="300" height="300">
            </div>
            <div class="mx-5">
                <div class="mb-3 mt-5">
                    <label for="nrp" class="form-label">NRP</label>
                    <input type="number" class="form-control form-control-sm" name="nrp" id="nrp"
                        aria-describedby="helpId" placeholder="" disabled value="{{ $User->nrp }}">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control form-control-sm" name="role" id="role"
                        aria-describedby="helpId" placeholder="" disabled value="{{ $User->role }}">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control form-control-sm" name="nama" id="nama"
                        aria-describedby="helpId" placeholder="" disabled value="{{ $User->nama }}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="pangkat">Pangkat</label>
                    <input type="text" class="form-control form-control-sm" name="pangkat" id="pangkat" placeholder=""
                        disabled value="{{ $User->pangkat }}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="staff">Staff</label>
                    <input type="text" class="form-control form-control-sm" id="staff" name="staff" disabled
                        value="{{ $User->staff }}">
                </div>
                {{-- <div class="mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control form-control-sm" name="" id=""
                        aria-describedby="helpId" placeholder="" disabled value="{{ $User->username }}">
                </div>
                <div class="mb-5">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-sm" name="" id=""
                        aria-describedby="helpId" placeholder="" disabled value="{{ $User->password }}">
                </div> --}}
            </div>
        </div>
    @endsection
