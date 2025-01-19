@extends('layouts.main')

@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 fw-bold">Detail Surat</h1>

        {{-- <div class="card shadow mb-4"> --}}
        {{-- <div class="card-header ">
                <a href="/dashboard/disposisi/{{ $SuratKeluar->id }}" class="btn btn-success rounded-pill shadow-sm">
                    <i class="fas fa-add fa-sm text-white-50"></i>Info Disposisi Surat
                </a>
            </div> --}}
        {{-- form control --}}
        <div class="card shadow mb-4 py-5 px-3 ">
            <div class="row justify-content-center align-items-center">
                <div>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $SuratKeluar->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Surat</th>
                            <td>{{ $SuratKeluar->nomor_surat }}</td>
                        </tr>
                        <tr>
                            <th>Pengirim</th>
                            <td>{{ $SuratKeluar->pengirim }}</td>
                        </tr>
                        <tr>
                            <th>Penerima</th>
                            <td>{{ $SuratKeluar->penerima_ids }}</td>
                        </tr>
                        <tr>
                            <th>Tebusan</th>
                            <td>{{ $SuratKeluar->tembusan }}</td>
                        </tr>
                        <tr>
                            <th>file</th>
                            <td>{{ $SuratKeluar->file_pdf }}</td>
                        </tr>
                        <tr>
                            <th>Perihal</th>
                            <td>
                                <input id="x" type="hidden" name="perihal" value="{{ $SuratKeluar->perihal }}"required
                                    autofocus>
                                <trix-editor input="x" placeholder="Masukan Keterangan" id="perihal" name="perihal"
                                    autofocus>
                                </trix-editor>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="mx-auto text-center">
                    <embed src="{{ asset('storage/assets/pdf/' . $SuratKeluar->file_pdf) }}" type="application/pdf"
                        width="600" height="850">
                    {{-- <iframe src="{{ Storage::url('assets/pdf/' . $SuratKeluar->file_pdf) }}" frameborder="0" width="600"
                            height="800"></iframe> --}}
                </div>

            </div>
        </div>
        {{-- </div> --}}
    </div>
@endsection
