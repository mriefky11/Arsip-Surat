<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DaftarPenggunaController extends Controller
{
    public function index()
    {
        $user = User::orderBy('created_at', 'desc')->get();
        return view('dashboard.daftar_pengguna', ['User' => $user]);
    }
    public function show($id)
    {
        $user = User::find($id);
        // return $akun;
        return view('dashboard.daftar_pengguna.show', ['User' => $user]);
    }
}
