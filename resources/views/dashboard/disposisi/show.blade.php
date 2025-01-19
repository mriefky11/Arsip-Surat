@extends('layouts.main')

@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 fw-bold">Detail Disposisi Surat</h1>

        {{-- form control --}}

        <div class="card shadow mb-4 py-5 px-3">
            <form action="/dashboard/disposisi/" method="POST" class="px-4">
                @csrf
                <div class="mb-3">
                    {{-- <label for="pengirim" class="form-label">Nama Pengirim</label> --}}
                    <input hidden type="text"
                        class="form-control form-control-sm @error('id_pengirim') is-invalid @enderror" name="id_pengirim"
                        id="id_pengirim" placeholder="" autofocus required
                        value="{{ old('id_pengirim', Auth()->user()->id) }}">
                    {{-- @error('pengirim_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror --}}
                </div>
                <div class="mb-3">
                    <label for="nomor_surat" class="form-label">Nomor Surat</label>
                    <input disabled type="text"
                        class="form-control form-control-sm @error('nomor_surat') is-invalid @enderror" name="nomor_surat"
                        id="nomor_surat" placeholder="" autofocus value="{{ old('nomor_surat', $disposisi->nomor_surat) }}">
                    @error('nomor_surat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_dikirim" class="form-label">Tanggal Dikirim</label>
                    <input disabled type="text"
                        class="form-control form-control-sm @error('tanggal_dikirim') is-invalid @enderror"
                        name="tanggal_dikirim" id="tanggal_dikirim" placeholder="" autofocus
                        value="{{ old('tanggal_dikirim', $disposisi->created_at) }}">
                    @error('tanggal_dikirim')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pengirim" class="form-label">Nama Pengirim</label>
                    <input disabled type="text"
                        class="form-control form-control-sm @error('pengirim') is-invalid @enderror" name="pengirim"
                        id="pengirim" placeholder="" autofocus value="{{ old('pengirim', $disposisi->pengirim) }}">
                    @error('pengirim')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_diterima" class="form-label">Tanggal Diterima</label>
                    <input disabled type="date"
                        class="form-control form-control-sm @error('tanggal_diterima') is-invalid @enderror"
                        name="tanggal_diterima" id="tanggal_diterima" placeholder="" autofocus required
                        value="{{ old('tanggal_diterima', $disposisi->tanggal_diterima) }}">
                    @error('tanggal_diterima')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="diterima_oleh" class="form-label">Nama Penerima</label>
                    <input disabled type="text"
                        class="form-control form-control-sm @error('diterima_oleh') is-invalid @enderror"
                        name="diterima_oleh" id="diterima_oleh" placeholder="" autofocus required
                        value="{{ old('diterima_oleh', $disposisi->diterima_oleh) }}">
                    @error('diterima_oleh')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-5">
                    <label for="isi_disposisi" class="form-label">Balasan</label>

                    <input id="x" type="hidden" name="isi_disposisi"
                        value="{{ old('isi_disposisi', $disposisi->isi_disposisi) }}"required autofocus>
                    @error('isi_disposisi')
                        <p>{{ $message }}</p>
                    @enderror
                    <trix-editor input="x" placeholder="Masukan Keterangan" id="isi_disposisi" name="isi_disposisi"
                        autofocus>

                    </trix-editor>
                </div>
                {{-- <div class="mb-3 d-flex">
                    <input type="submit" class="btn btn-success rounded-pill shadow-sm col-xl-2" value="Kirim">
                </div> --}}
            </form>
        </div>
    </div>
@endsection
