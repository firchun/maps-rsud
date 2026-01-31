<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', [App\Http\Controllers\PageController::class, 'index'])->name('welcome');
Route::get('/maps', [App\Http\Controllers\PageController::class, 'maps']);
Route::get('/semua-fasilitas', [App\Http\Controllers\PageController::class, 'fasilitas']);


Route::post('/search-tiket', [PageController::class, 'search_tiket'])->name('search-tiket');

Route::get('/detail-tiket/{barcode}', [App\Http\Controllers\PageController::class, 'detail_tiket'])->name('detail-tiket');
Route::get('/detail-fasilitas/{slug}', [App\Http\Controllers\PageController::class, 'detail'])->name('detail-fasilitas');

Auth::routes(['register' => false, 'reset' => false]);
Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //akun managemen
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware(['auth:web', 'role:Admin'])->group(function () {
    //fasilitas
    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas');
    Route::post('/fasilitas/store',  [FasilitasController::class, 'store'])->name('fasilitas.store');
    Route::get('/fasilitas/edit/{id}',  [FasilitasController::class, 'edit'])->name('fasilitas.edit');
    Route::delete('/fasilitas/delete/{id}',  [FasilitasController::class, 'destroy'])->name('fasilitas.delete');
    Route::get('/fasilitas-datatable', [FasilitasController::class, 'getFasilitasDataTable']);
    //fasilitas
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori/store',  [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/edit/{id}',  [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::delete('/kategori/delete/{id}',  [KategoriController::class, 'destroy'])->name('kategori.delete');
    Route::get('/kategori-datatable', [KategoriController::class, 'getKategoriDataTable']);
    //user managemen
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/store',  [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}',  [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/delete/{id}',  [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users-datatable', [UserController::class, 'getUsersDataTable']);
});
