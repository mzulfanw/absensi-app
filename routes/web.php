<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\DivisiController;
use App\Http\Controllers\Admin\PegawaiiController as AdminPegawaiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/absensi-pegawai', [PegawaiController::class, 'index'])->name('absen.pegawai');
Route::post('/absensi-pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.absen');
Route::get('/absensi-pegawai/selesai', [PegawaiController::class, 'index2'])->name('pegawai.absen2');
Route::post('/absensi-pegawai/keluar/{nomer_pegawai}', [PegawaiController::class, 'keluar'])->name('pegawai.logout');

// Login Admin
Route::post('auth', [AuthController::class, 'postLogin'])->name('auth.login');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::group([
    'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'auth'
], function () {
    Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard');

    // Routing buat user
    Route::get('/pegawai', [AdminPegawaiController::class, 'index'])->name('pegawai.page');
    Route::post('/pegawai/add', [AdminPegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/view/{id}', [AdminPegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::delete('/pegawai/{id}', [AdminPegawaiController::class, 'destroy'])->name('pegawai.delete');



    // Routing buat Divisi
    Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi.page');
    Route::post('/divisi/add', [DivisiController::class, 'store'])->name('divisi.store');
    Route::get('/divisi/view/{id}', [DivisiController::class, 'edit'])->name('divisi.edit');
    Route::delete('/divisi/{id}', [DivisiController::class, 'destroy'])->name('divisi.destroy');


    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.page');
    Route::get('/absensi/cetak', [AbsensiController::class, 'cetak'])->name('absensi.cetak');



    // Logout
});
