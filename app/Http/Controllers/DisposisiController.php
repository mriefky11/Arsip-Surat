<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $id_pengirim = auth()->id(); // Mendapatkan ID pengguna yang saat ini login
        $id_penerima = auth()->id();

        $disposisi = Disposisi::where(function ($query) use ($id_pengirim, $id_penerima) {
            $query->where('id_pengirim', $id_pengirim)
                ->orWhere('id_penerima', $id_penerima);
        })->orderBy('created_at', 'desc')->get();

        return view('dashboard.disposisi', ['disposisi' => $disposisi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {

        $suratMasuk = SuratMasuk::where('id', $id)->firstOrFail();
        return view('dashboard.disposisi.create', ['suratMasuk' => $suratMasuk]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'id_pengirim' => 'required',
            'id_penerima' => 'required',
            'nomor_surat' => 'required',
            'tanggal_dikirim' => 'required',
            'pengirim' => 'required',
            'tanggal_diterima' => 'required',
            'diterima_oleh' => 'required',
            'isi_disposisi' => 'required', // Batasan 10MB (sesuaikan dengan kebutuhan Anda)

        ]);
        Disposisi::create($validatedData);

        return redirect('dashboard/disposisi')->with('success', 'Berhasil mengirim disposisi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disposisi $disposisi)
    {
        return view('dashboard.disposisi.show', ['disposisi' => $disposisi]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $disposisi = Disposisi::where('id', $id)->first();
        return view('dashboard.disposisi.edit', [
            'Disposisi' => $disposisi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disposisi $disposisi)
    {
        // return $request;
        $rules = [
            'id_pengirim' => 'required',
            'nomor_surat' => 'required',
            'tanggal_dikirim' => 'required',
            'pengirim' => 'required',
            'tanggal_diterima' => 'required',
            'diterima_oleh' => 'required',
            'isi_disposisi' => 'required',
        ];

        $validatedData = $request->validate($rules);

        // Simpan perubahan ke dalam database
        $disposisi->update([
            'id_pengirim' => $validatedData['id_pengirim'],
            'nomor_surat' =>  $validatedData['nomor_surat'],
            'tanggal_dikirim' =>  $validatedData['tanggal_dikirim'],
            'pengirim' =>  $validatedData['pengirim'],
            'tanggal_diterima' =>  $validatedData['tanggal_diterima'],
            'diterima_oleh' =>  $validatedData['diterima_oleh'],
            'isi_disposisi' =>  $validatedData['isi_disposisi'],
        ]);

        return redirect('dashboard/disposisi')->with('success', 'Berhasil mengubah disposisi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disposisi $disposisi)
    {
        Disposisi::destroy($disposisi->id);
        return redirect('dashboard/disposisi')->with('success', 'Berhasil menghapus disposisi surat');
    }
}
