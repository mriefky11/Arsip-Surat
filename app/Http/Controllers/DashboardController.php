<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Ganti $pengirimId dengan ID pengguna yang ingin Anda hitung surat keluarnya
        $pengirimId = auth()->user()->id; // Contoh ID pengguna
        $penerima = auth()->user()->nama;

        $pengguna = User::count();
        if (auth()->user()->isAdmin()) {
            // Admin
            $jumlahSuratMasuk = SuratMasuk::where(function ($query) use ($penerima) {
                $query->where('penerima_ids', 'LIKE', "%$penerima%")
                      ->orWhereHas('pengirim', function ($subQuery) {
                          $subQuery->where('role', 'admin');
                      });
            })->count();
        } else {
            // User biasa
            $jumlahSuratMasuk = SuratMasuk::where('penerima_ids', 'LIKE', '%' . $penerima . '%')->count();
        }
        
        $jumlahSuratKeluar = SuratKeluar::where('pengirim_id', $pengirimId)->count();
        $jumlahDisposisi = Disposisi::where('id_penerima', $pengirimId)->count();
        return view('dashboard.index', ['jumlahSuratKeluar' => $jumlahSuratKeluar, 'jumlahSuratMasuk' => $jumlahSuratMasuk, 'pengguna' => $pengguna, 'jumlahDisposisi' => $jumlahDisposisi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
