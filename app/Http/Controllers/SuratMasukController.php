<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        // Mengambil daftar surat masuk pengguna yang saat ini login
        $penerima = Auth::user()->nama;
        $pengirimId = Auth::user()->id;

        // return($pengirimId);
        // $suratMasuk = SuratMasuk::where('penerima_ids', 'LIKE', "%$penerima%")->get();
        $category = Category::all();
        
        if (auth()->user()->isAdmin()) {
            // Admin
            // $suratMasuk = SuratMasuk::where('pengirim_id', $pengirimId)->get();
            $suratMasuk = SuratMasuk::where(function ($query) use ($penerima) {
                $query->where('penerima_ids', 'LIKE', "%$penerima%")
                      ->orWhereHas('pengirim', function ($subQuery) {
                          $subQuery->where('role', 'admin');
                      });
            })->get();
        } else {
            // User biasa
            $suratMasuk = SuratMasuk::where('penerima_ids', 'LIKE', "%$penerima%")->get();
        }
        
        // return($suratMasuk);

        // Filter surat keluar berdasarkan kategori jika parameter category_id ada
        if ($request->has('category_id')) {
            $category_id = $request->input('category_id');
            $suratMasuk = $suratMasuk->where('category_id', $category_id);
        }

        foreach ($suratMasuk as $surat) {
            $surat->perihal_limited = $surat->getPerihalLimitedAttribute();
        }

        return view('dashboard.surat_masuk', compact('suratMasuk', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */


    public function create()
    {
        $category = Category::all();
        $users = User::all();
        return view('dashboard.surat_masuk.create', ['users' => $users, 'category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'nomor_surat' => 'required|unique:surat_masuk',
            'category' => 'required',
            'pengirim_id' => 'required',
            'pengirim' => 'required',
            'penerima_ids' => 'required',
            'tembusan' => 'required',
            'file_pdf' => 'required|file|mimes:pdf|max:10240', // Batasan 10MB (sesuaikan dengan kebutuhan Anda)
            'perihal' => 'required',
        ]);

        if ($request->hasFile('file_pdf')) { // Perbaiki pengecekan nama field file
            $file = $request->file('file_pdf'); // Perbaiki nama field file

            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan file di direktori 'storage/app/assets'
            $file->storeAs('assets/pdf', $filename);

            SuratMasuk::create([
                'nomor_surat' => $validatedData['nomor_surat'],
                'category_id' => $validatedData['category'],
                'pengirim_id' => $validatedData['pengirim_id'],
                'pengirim' => $validatedData['pengirim'],
                'penerima_ids' => $validatedData['penerima_ids'],
                'tembusan' => $validatedData['tembusan'],
                'perihal' => $validatedData['perihal'],
                'file_pdf' => $filename
            ]);

            return redirect('dashboard/surat_masuk')->with('success', 'Berhasil menambahkan surat');
        } else {
            return redirect()->back()->with('error', 'File tidak terunggah dengan benar.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $suratKeluar = SuratMasuk::find($id);
        return view('dashboard.surat_masuk.show', ['suratMasuk' => $suratKeluar]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        $category = Category::all();

        return view('dashboard.surat_masuk.edit', [
            'suratMasuk' => $suratMasuk,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $rules = [
            'category' => 'required',
            'pengirim' => 'required',
            'penerima_ids' => 'required',
            'tembusan' => 'required',
            'file_pdf' => 'file|mimes:pdf|max:10240', // Batasan 10MB (sesuaikan dengan kebutuhan Anda)
            'perihal' => 'required',
        ];

        if ($request->nomor_surat != $suratMasuk->nomor_surat) {
            $rules['nomor_surat'] = 'required|unique:surat_masuk';
        }

        $validatedData = $request->validate($rules);

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan file di direktori 'storage/app/public/assets/pdf'
            $file->storeAs('assets/pdf', $filename);

            // Update data surat keluar
            $suratMasuk->update([
                'nomor_surat' => $validatedData['nomor_surat'] ?? $suratMasuk->nomor_surat,
                'category_id' => $validatedData['category'],
                'pengirim' => $validatedData['pengirim'],
                'penerima_ids' => $validatedData['penerima_ids'],
                'tembusan' => $validatedData['tembusan'],
                'perihal' => $validatedData['perihal'],
                'file_pdf' => $filename,
            ]);

            return redirect('dashboard/surat_masuk')->with('success', 'Berhasil mengupdate surat');
        } else {
            // Jika tidak ada file yang diunggah, update data tanpa mengubah file
            $suratMasuk->update([
                'nomor_surat' => $validatedData['nomor_surat'] ?? $suratMasuk->nomor_surat,
                'category_id' => $validatedData['category'],
                'pengirim' => $validatedData['pengirim'],
                'penerima_ids' => $validatedData['penerima_ids'],
                'tembusan' => $validatedData['tembusan'],
                'perihal' => $validatedData['perihal'],
            ]);

            return redirect('dashboard/surat_masuk')->with('success', 'Berhasil mengupdate surat');

            // return($suratMasuk);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        $filePath = 'assets/pdf/' . $suratMasuk->file_pdf;

        // Hapus data dari database
        SuratMasuk::destroy($suratMasuk->id);

        // Hapus file dari penyimpanan jika alamat file ada
        if ($filePath) {
            Storage::delete($filePath);
        }
        return redirect('dashboard/surat_masuk')->with('success', 'Berhasil menghapus surat');
    }
}
