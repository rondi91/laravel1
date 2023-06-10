<?php

use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransactionsController;
use App\Models\Transactions;
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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});


Route::get('/', [Dashboardcontroller::class, 'index'])->name('dashboard.index');


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

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
// Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.updates');
Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');
Route::patch('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');


// pesan
Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
Route::get('/pesan/create', [PesanController::class, 'create'])->name('pesan.create');
Route::get('/pesan/{pesan}/edit', [PesanController::class, 'edit'])->name('pesan.edit');
Route::get('/ßesan/{pesan}', [PesanController::class, 'show'])->name('pesan.show');
Route::post('/pesan', [PesanController::class, 'store'])->name('pesan.store');
Route::get('/pesan/searchPelanggan', [PesanController::class, 'searchPelanggan'])->name('pelanggan.search');
Route::delete('/pesan{pesan}', [PesanController::class, 'destroy'])->name('pesan.destroy');

Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.index');
Route::get('/transactions/{id}', [TransactionsController::class, 'show'])->name('transactions.show');
// Route::get('/transactions/create{id}', [TransactionsController::class, 'create'])->name('transactions.create');
Route::get('/transactions/create/{pesanan_id}', [TransactionsController::class, 'create'])->name('transactions.create');
Route::post('/transactions', [TransactionsController::class, 'store'])->name('transactions.store');
Route::get('/transactions/{id}/edit', [TransactionsController::class, 'edit'])->name('transactions.edit');
Route::put('/transactions/{id}', [TransactionsController::class, 'update'])->name('transactions.update');
Route::delete('/transactions/{id}', [TransactionsController::class, 'destroy'])->name('transactions.destroy');

Route::post('/pembayaran', 'PembayaranController@store')->name('pembayaran.store');