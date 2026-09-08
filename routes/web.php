<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

// Halaman utama redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ─── Semua route inventory wajib login (middleware auth) ───────────────────
Route::middleware(['auth'])->group(function () {

    // Dashboard → tampilkan daftar barang & ringkasan
    Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');

    // ── Khusus Admin: tambah & hapus barang ─────────────────────────────────
    // PENTING: route statis (/items/create) harus di atas route dinamis ({item})
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/items/create',    [ItemController::class, 'create'])->name('items.create');
        Route::post('/items',          [ItemController::class, 'store'])->name('items.store');
        Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    });

    // ── Admin & Staff: lihat daftar, edit, update stok ──────────────────────
    Route::get('/items',              [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/{item}/edit',  [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}',       [ItemController::class, 'update'])->name('items.update');
    Route::patch('/items/{item}',     [ItemController::class, 'update']);

    // Profile
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
