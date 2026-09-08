<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\JsonResponse;

class ItemApiController extends Controller
{
    /**
     * GET /api/barang
     * Mengembalikan daftar seluruh barang dalam format JSON.
     */
    public function index(): JsonResponse
    {
        $items = Item::select(
            'kode_barang',
            'nama_barang',
            'kategori',
            'stok',
            'satuan',
            'harga_satuan',
            'keterangan'
        )->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Daftar seluruh barang',
            'total'   => $items->count(),
            'data'    => $items,
        ]);
    }

    /**
     * GET /api/barang/{kode}
     * Mengembalikan detail satu barang berdasarkan Kode Barang.
     */
    public function show(string $kode): JsonResponse
    {
        $item = Item::where('kode_barang', $kode)->first();

        if (!$item) {
            return response()->json([
                'status'  => 'error',
                'message' => "Barang dengan kode \"$kode\" tidak ditemukan.",
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Detail barang',
            'data'    => $item,
        ]);
    }
}
