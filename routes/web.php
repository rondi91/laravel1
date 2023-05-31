<?php

use App\Http\Controllers\PaketController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('admin.dashboard');
});



Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// Route::post('/posts', function () {
//     return view('admin.dashboard');
// })->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/pelanggans', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggans/create', [pelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggans', [pelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggans/{id}', [pelangganController::class, 'show'])->name('pelanggan.show');
Route::get('/pelanggans/{pelanggan}/edit', [pelangganController::class, 'edit'])->name('pelanggan.edit');
Route::put('/pelanggans/{pelanggan}', [pelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggans/{pelanggan}', [pelangganController::class, 'destroy'])->name('pelanggan.destroy');
Route::get('/pelanggan/search', [pelangganController::class, 'search'])->name('pelanggan.search');

Route::get('/pakets', [PaketController::class, 'index'])->name('paket.index');
Route::get('/pakets/create', [paketController::class, 'create'])->name('paket.create');
Route::post('/pakets', [paketController::class, 'store'])->name('paket.store');
Route::get('/pakets/{id}', [paketController::class, 'show'])->name('paket.show');
Route::get('/pakets/{id}/edit', [paketController::class, 'edit'])->name('paket.edit');
Route::put('/pakets/{id}', [paketController::class, 'update'])->name('paket.update');
Route::delete('/pakets/{id}', [paketController::class, 'destroy'])->name('paket.destroy');
Route::get('/paket/search', [paketController::class, 'search'])->name('paket.search');


Route::get('/pembayarans', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::get('/pembayarans/create', [pembayaranController::class, 'create'])->name('pembayaran.create');
Route::post('/pembayarans', [pembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/pembayarans/{id}', [pembayaranController::class, 'show'])->name('pembayaran.show');
Route::get('/pembayarans/{id}/edit', [pembayaranController::class, 'edit'])->name('pembayaran.edit');
Route::put('/pembayarans/{id}', [pembayaranController::class, 'update'])->name('pembayaran.update');
Route::delete('/pembayarans/{id}', [pembayaranController::class, 'destroy'])->name('pembayaran.destroy');
Route::get('/pembayran/search', [pembayaranController::class, 'search'])->name('pembayaran.search');
Route::get('/pembayran/{id}/detail', [pembayaranController::class, 'detail'])->name('pembayaran.detail');
Route::get('/pembayran/print', [pembayaranController::class, 'print'])->name('pembayaran.print');
Route::get('/pembayaran/searchPelanggan', [pembayaranController::class, 'searchPelanggan'])->name('pembayaran.searchPelanggan');
