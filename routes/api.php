<?php

use App\Http\Controllers\ItemApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes — Inventory System
|--------------------------------------------------------------------------
| Endpoint API untuk integrasi dengan sistem lain (misalnya kasir).
| Tidak memerlukan autentikasi (public API).
*/

// GET /api/barang         → daftar semua barang
Route::get('/barang', [ItemApiController::class, 'index']);

// GET /api/barang/{kode}  → detail barang by kode
Route::get('/barang/{kode}', [ItemApiController::class, 'show']);
