<?php

namespace App\Http\Controllers;

// use App\Models\akun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardUserController extends Controller
{

    protected $model = User::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('created_at', 'desc')->get();
        return view('dashboard.kelola_akun', ['User' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kelola_akun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'nrp' => 'required|unique:users',
            'role' => 'required',
            'nama' => 'required',
            'pangkat' => 'required',
            'staff' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'foto' => 'required|image|file|max:2048',
        ]);

        if ($request->file('foto')) {
            // $filename = time() . '.' . $request->getClientOriginalExtension();
            $validatedData['foto'] = $request->file('foto')->store('assets/images');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect('dashboard/kelola_akun')->with('success', 'Berhasil menambahkan akun');
    }

    /**
     * Display the specified resource.
     */
    // public function show(akun $akun)
    // {
    //     // return $akun;
    //     // return view('dashboard.kelola_akun.show', ['Akun' => $akun]);

    // }

    public function show($id)
    {
        $user = User::find($id);
        // return $akun;
        return view('dashboard.kelola_akun.show', ['User' => $user]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        // return $user;
        return view('dashboard.kelola_akun.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, User $user)
    // {
    //     $rules = [
    //         'role' => 'required',
    //         'nama' => 'required',
    //         'pangkat' => 'required',
    //         'staff' => 'required',
    //         'password' => 'required',
    //         'foto' => 'image|file|max:2048',
    //     ];

    //     if ($request->nrp != $user->nrp) {
    //         $rules['nrp'] = 'required|unique:users';
    //     }

    //     if ($request->username != $user->username) {
    //         $rules['username'] = 'required|unique:users';
    //     }

    //     $validatedData = $request->validate($rules);

    //     if ($request->file('foto')) {
    //         $validatedData['foto'] = $request->file('foto')->store('assets/images');

    //         // return $validatedData;
    //         $user->update([
    //             'nrp' => $validatedData['nrp'] ?? $user->nrp,
    //             'role' => $validatedData['role'],
    //             'nama' => $validatedData['nama'],
    //             'pangkat' => $validatedData['pangkat'],
    //             'staff' => $validatedData['staff'],
    //             'username' => $validatedData['username'] ?? $user->username,
    //             'password' => $validatedData['password'] ?? $user->password,
    //             'foto' => $validatedData['foto'],
    //         ]);

    //         return redirect('dashboard/kelola_akun')->with('success', 'Berhasil mengubah akun');
    //     } else {
    //         // return $validatedData;
    //         $user->update([
    //             'nrp' => $validatedData['nrp'] ?? $user->nrp,
    //             'role' => $validatedData['role'],
    //             'nama' => $validatedData['nama'],
    //             'pangkat' => $validatedData['pangkat'],
    //             'staff' => $validatedData['staff'],
    //             'username' => $validatedData['username'] ?? $user->username,
    //             'password' => $validatedData['password'] ?? $user->password,
    //         ]);
    //         return redirect('dashboard/kelola_akun')->with('success', 'Berhasil mengubah akun');
    //     }
    // }

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

        return redirect('dashboard/kelola_akun')->with('success', 'Berhasil mengubah akun');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Ambil alamat file dari database
        $user = User::find($id);
        $filePath = $user->foto;

        // Hapus data dari database
        User::destroy($id);

        // Hapus file dari penyimpanan jika alamat file ada
        if ($filePath) {
            Storage::delete($filePath);
        }
        return redirect('dashboard/kelola_akun')->with('success', 'Berhasil menghapus data');
    }
}
