<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PengendaraController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\JenisPelanggaranController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    /*
    |--------------------------------------------------------------------------
    | CRUD Petugas
    |--------------------------------------------------------------------------
    */

    Route::resource('petugas', PetugasController::class);

    /*
    |--------------------------------------------------------------------------
    | CRUD Pengendara
    |--------------------------------------------------------------------------
    */

    Route::resource('pengendara', PengendaraController::class);

    /*
    |--------------------------------------------------------------------------
    | CRUD Kendaraan
    |--------------------------------------------------------------------------
    */

    Route::resource('kendaraan', KendaraanController::class);

    /*
    |--------------------------------------------------------------------------
    | CRUD Jenis Pelanggaran
    |--------------------------------------------------------------------------
    */

    Route::resource('jenis-pelanggaran', JenisPelanggaranController::class);

    /*
    |--------------------------------------------------------------------------
    | CRUD Pelanggaran
    |--------------------------------------------------------------------------
    */

    Route::resource('pelanggaran', PelanggaranController::class);

    Route::get('/laporan', [LaporanController::class,'index'])->name('laporan.index');

Route::get('/laporan/pdf', [LaporanController::class,'pdf'])->name('laporan.pdf');

Route::middleware(['auth','role:admin'])->group(function () {

    Route::resource('petugas', PetugasController::class);

    Route::resource('jenis-pelanggaran', JenisPelanggaranController::class);

    Route::resource('users', UserController::class);

});

});