<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function rekomendasiPenerima(Request $request)
    {
        $search = $request->input('search');

        // Query database untuk mencari pengguna berdasarkan pencarian (nama atau username)
        $users = User::where('nama', 'LIKE', "%$search%")
            ->orWhere('username', 'LIKE', "%$search%")
            ->get();

        return response()->json($users);
    }
}
