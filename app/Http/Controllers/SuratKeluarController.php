<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $user = auth()->user(); // Mendapatkan pengguna yang saat ini login
        $SuratKeluar = $user->suratKeluar; // Mendapatkan semua surat keluar yang terkait dengan pengguna
        $category = Category::all();

        // Filter surat keluar berdasarkan kategori jika parameter category_id ada
        if ($request->has('category_id')) {
            $category_id = $request->input('category_id');
            $SuratKeluar = $SuratKeluar->where('category_id', $category_id);
        }

        foreach ($SuratKeluar as $surat) {
            $surat->perihal_limited = $surat->getPerihalLimitedAttribute();
        }

        return view('dashboard.surat_keluar', compact('SuratKeluar', 'category'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $users = User::all();
        return view('dashboard.surat_keluar.create', ['users' => $users, 'category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'nomor_surat' => 'required|unique:surat_keluar',
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

            SuratKeluar::create([
                'nomor_surat' => $validatedData['nomor_surat'],
                'category_id' => $validatedData['category'],
                'pengirim_id' => $validatedData['pengirim_id'],
                'pengirim' => $validatedData['pengirim'],
                'penerima_ids' => $validatedData['penerima_ids'],
                'tembusan' => $validatedData['tembusan'],
                'perihal' => $validatedData['perihal'],
                'file_pdf' => $filename
            ]);

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

            
            return redirect('dashboard/surat_keluar')->with('success', 'Berhasil mengirim surat');
        } else {
            return redirect()->back()->with('error', 'File tidak terunggah dengan benar.');
        }
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nomor_surat' => 'required|unique:surat_keluar',
    //         'pengirim_id' => 'required',
    //         'penerima_ids' => 'required',
    //         'perihal' => 'required',
    //     ]);

    //     SuratKeluar::create([
    //         'nomor_surat' => $request->nomor_surat,
    //         'pengirim_id' => $request->pengirim_id,
    //         'penerima_ids' => implode(',', $request->penerima_ids),
    //         'tembusan' => $request->tembusan,
    //         'file_pdf' => $request->file_pdf,
    //         'perihal' => $request->perihal,
    //     ]);

    //     return redirect()->route('suratkeluar.create')->with('success', 'Surat berhasil dikirim');
    // }


    /**
     * Display the specified resource.
     */
    public function show(SuratKeluar $suratKeluar)
    {
        // ddd($suratKeluar);
        // return $suratKeluar;
        return view('dashboard.surat_keluar.show', ['SuratKeluar' => $suratKeluar]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratKeluar $suratKeluar)
    {
        // $SuratKeluar = SuratKeluar::orderByDesc('created_at')->orderByDesc('id')->get();
        $category = Category::all();

        return view('dashboard.surat_keluar.edit', [
            'suratKeluar' => $suratKeluar,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $rules = [
            'category' => 'required',
            'pengirim' => 'required',
            'penerima_ids' => 'required',
            'tembusan' => 'required',
            'file_pdf' => 'file|mimes:pdf|max:10240', // Batasan 10MB (sesuaikan dengan kebutuhan Anda)
            'perihal' => 'required',
        ];

        if ($request->nomor_surat != $suratKeluar->nomor_surat) {
            $rules['nomor_surat'] = 'required|unique:surat_keluar';
        }

        $validatedData = $request->validate($rules);

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan file di direktori 'storage/app/public/assets/pdf'
            $file->storeAs('assets/pdf', $filename);

            // Update data surat keluar
            $suratKeluar->update([
                'nomor_surat' => $validatedData['nomor_surat'] ?? $suratKeluar->nomor_surat,
                'category_id' => $validatedData['category'],
                'pengirim' => $validatedData['pengirim'],
                'penerima_ids' => $validatedData['penerima_ids'],
                'tembusan' => $validatedData['tembusan'],
                'perihal' => $validatedData['perihal'],
                'file_pdf' => $filename,
            ]);

            return redirect('dashboard/surat_keluar')->with('success', 'Berhasil mengupdate surat');
        } else {
            // Jika tidak ada file yang diunggah, update data tanpa mengubah file
            $suratKeluar->update([
                'nomor_surat' => $validatedData['nomor_surat'] ?? $suratKeluar->nomor_surat,
                'category_id' => $validatedData['category'],
                'pengirim' => $validatedData['pengirim'],
                'penerima_ids' => $validatedData['penerima_ids'],
                'tembusan' => $validatedData['tembusan'],
                'perihal' => $validatedData['perihal'],
            ]);

            return redirect('dashboard/surat_keluar')->with('success', 'Berhasil mengupdate surat');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKeluar $suratKeluar)
    {
        $filePath = 'assets/pdf/' . $suratKeluar->file_pdf;

        // Hapus data dari database
        SuratKeluar::destroy($suratKeluar->id);

        // Hapus file dari penyimpanan jika alamat file ada
        if ($filePath) {
            Storage::delete($filePath);
        }
        return redirect('dashboard/surat_keluar')->with('success', 'Berhasil menghapus surat');
    }

    // app/Http/Controllers/SuratKeluarController.php

    // public function filterResults(Request $request)
    // {
    //     $categoryId = $request->input('category_id');

    //     $suratKeluar = SuratKeluar::where('category_id', $categoryId)->get();
    //     $category = Category::all();

    //     return view('dashboard.surat_keluar.filter_results', compact('suratKeluar', 'category'));
    // }





    // app/Http/Controllers/SuratKeluarController.php

}
