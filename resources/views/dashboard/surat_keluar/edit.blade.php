@extends('layouts.main')

@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 fw-bold">Edit Surat keluar</h1>

        {{-- form control --}}
        <div class="card shadow mb-4 py-5 px-3">
            <form action="/dashboard/surat_keluar/{{ $suratKeluar->id }}" method="POST" class="px-4"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nomor_surat" class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control form-control-sm @error('nomor_surat') is-invalid @enderror"
                        name="nomor_surat" id="nomor_surat" placeholder="" autofocus required
                        value="{{ old('nomor_surat', $suratKeluar->nomor_surat) }}">
                    @error('nomor_surat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori Surat</label>
                    <select class="form-select form-select-sm" name="category" id="category">
                        @foreach ($category as $item)
                            @if (old('category', $suratKeluar->category_id) == $item->id)
                                <option value="{{ $item->id }}" selected>{{ $item->category }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->category }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pengirim" class="form-label">Nama Pengirim</label>
                    <input type="text" class="form-control form-control-sm @error('pengirim') is-invalid @enderror"
                        name="pengirim" id="pengirim" placeholder="" autofocus required
                        value="{{ old('pengirim', $suratKeluar->pengirim) }}">
                    @error('pengirim')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="penerima_ids" class="form-label">Kepada</label>
                    <input type="text" class="form-control form-control-sm @error('penerima_ids') is-invalid @enderror"
                        name="penerima_ids" id="penerima_ids" placeholder="" autofocus required
                        value="{{ old('penerima_ids', $suratKeluar->penerima_ids) }}">
                    @error('penerima_ids')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tembusan" class="form-label">Tembusan</label>
                    <input type="text" class="form-control form-control-sm @error('tembusan') is-invalid @enderror"
                        name="tembusan" id="tembusan" placeholder="" autofocus
                        value="{{ old('tembusan', $suratKeluar->tembusan) }}">
                    @error('tembusan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="file_pdf" class="form-label">File(.pdf)</label>
                    <input multiple type="file" class="form-control @error('file_pdf') is-invalid @enderror"
                        id="file_pdf" name="file_pdf" autofocus value="{{ old('file_pdf', $suratKeluar->file_pdf) }}">
                    @error('file_pdf')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="perihal" class="form-label">Perihal</label>

                    <input id="x" type="hidden" name="perihal"
                        value="{{ old('perihal', $suratKeluar->perihal) }}"required autofocus>
                    @error('perihal')
                        <p>{{ $message }}</p>
                    @enderror
                    <trix-editor input="x" placeholder="Masukan Keterangan" id="perihal" name="perihal" autofocus>

                    </trix-editor>
                </div>
                <div class="mb-3 d-flex">
                    <input type="submit" class="btn btn-success rounded-pill shadow-sm col-xl-2" value="Kirim">
                </div>
            </form>
        </div>
    </div>
@endsection
