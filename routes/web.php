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

Route::get('/pelanggans', [PelangganController::class, 'index']);
Route::get('/pelanggans/create', [pelangganController::class, 'create']);
Route::post('/pelanggans', [pelangganController::class, 'store']);
Route::get('/pelanggans/{id}', [pelangganController::class, 'show']);
Route::get('/pelanggans/{id}/edit', [pelangganController::class, 'edit']);
Route::put('/pelanggans/{id}', [pelangganController::class, 'update']);
Route::delete('/pelanggans/{id}', [pelangganController::class, 'destroy']);

Route::get('/pakets', [PaketController::class, 'index']);
Route::get('/pakets/create', [paketController::class, 'create']);
Route::post('/pakets', [paketController::class, 'store']);
Route::get('/pakets/{id}', [paketController::class, 'show']);
Route::get('/pakets/{id}/edit', [paketController::class, 'edit']);
Route::put('/pakets/{id}', [paketController::class, 'update']);
Route::delete('/pakets/{id}', [paketController::class, 'destroy']);



Route::get('/pembayarans', [PembayaranController::class, 'index']);
Route::get('/pembayarans/create', [pembayaranController::class, 'create']);
Route::post('/pembayarans', [pembayaranController::class, 'store']);
Route::get('/pembayarans/{id}', [pembayaranController::class, 'show']);
Route::get('/pembayarans/{id}/edit', [pembayaranController::class, 'edit']);
Route::put('/pembayarans/{id}', [pembayaranController::class, 'update']);
Route::delete('/pembayarans/{id}', [pembayaranController::class, 'destroy']);