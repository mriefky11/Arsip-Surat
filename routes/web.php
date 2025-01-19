<?php

use App\Http\Controllers\DaftarPenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('dashboard/profile', function () {
    return view('dashboard.profile', [
        "title" => 'Profile',
    ]);
})->middleware('auth');

Route::get('/', function () {
    return view('login');
})->middleware('guest');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::resource('/dashboard/surat_keluar', SuratKeluarController::class)->middleware('auth');

Route::resource('/dashboard/surat_masuk', SuratMasukController::class)->middleware('auth');

Route::resource('/dashboard/profile', ProfileController::class)->middleware('auth');

Route::resource('/dashboard/daftar_pengguna', DaftarPenggunaController::class)->middleware('auth');

Route::resource('/dashboard/disposisi', DisposisiController::class)->middleware('auth');
Route::get('/dashboard/disposisi/create/{nomor_surat}', [DisposisiController::class, 'create'])->middleware('auth');
Route::get('/dashboard/disposisi/{nomor_surat}/edit', [DisposisiController::class, 'edit'])->middleware('auth');

Route::middleware(['auth', 'AdminMiddleware'])->group(function () {
    Route::resource('/dashboard/kelola_akun', DashboardUserController::class);
});