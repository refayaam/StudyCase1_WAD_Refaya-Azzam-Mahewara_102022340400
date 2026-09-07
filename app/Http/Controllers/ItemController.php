<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // 1. Dashboard Ringkasan & Lihat Semua Data
    public function index()
    {
        $items = Item::all();
        $totalItems = $items->count();
        $totalStok = $items->sum('stok');

        return view('items.index', compact('items', 'totalItems', 'totalStok'));
    }

    // 2. Form Tambah Barang
    public function create()
    {
        return view('items.create');
    }

    // 3. Simpan Data Baru + Validasi Kode Barang Unik
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:items,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        Item::create([
            'kode_barang' => $validated['kode_barang'],
            'nama_barang' => $validated['nama_barang'],
            'stok' => $validated['stok'],
            'harga_satuan' => $validated['harga_satuan'],
        ]);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    // 4. Form Edit Barang
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    // 5. Update Data Barang
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:items,kode_barang,' . $item->id,
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $item->update([
            'kode_barang' => $validated['kode_barang'],
            'nama_barang' => $validated['nama_barang'],
            'stok' => $validated['stok'],
            'harga_satuan' => $validated['harga_satuan'],
        ]);

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui!');
    }

    // 6. Hapus Data Barang
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
    }
}