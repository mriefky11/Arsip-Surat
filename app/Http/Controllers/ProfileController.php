<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {

        $id = Auth()->user()->id;
        $user = User::find($id);
        // return $user;
        return view('dashboard.profile', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'role' => 'required',
            'nama' => 'required',
            'pangkat' => 'required',
            'staff' => 'required',
            'password' => 'required',
            'foto' => 'image|file|max:2048',
        ];

        $user = User::findOrFail($id);

        if ($request->nrp != $user->nrp) {
            $rules['nrp'] = 'required|unique:users';
        }

        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('assets/images');
        } else {
            $validatedData['foto'] = $user->foto; // Gunakan foto yang ada jika tidak ada file yang diunggah
        }

        $user->update([
            'nrp' => $validatedData['nrp'] ?? $user->nrp,
            'role' => $validatedData['role'],
            'nama' => $validatedData['nama'],
            'pangkat' => $validatedData['pangkat'],
            'staff' => $validatedData['staff'],
            'username' => $validatedData['username'] ?? $user->username,
            'password' => $validatedData['password'] ?? $user->password,
            'foto' => $validatedData['foto'],
        ]);

        return redirect('dashboard/profile')->with('success', 'Berhasil mengubah profil');
    }
}
