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
        $totalNilai = $items->sum(fn($item) => $item->stok * $item->harga_satuan);

        return view('items.index', compact('items', 'totalItems', 'totalStok', 'totalNilai'));
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
            'kode_barang'  => 'required|unique:items,kode_barang',
            'nama_barang'  => 'required|string|max:255',
            'kategori'     => 'required|string|max:100',
            'stok'         => 'required|integer|min:0',
            'satuan'       => 'required|string|max:50',
            'harga_satuan' => 'required|numeric|min:0',
            'keterangan'   => 'nullable|string',
        ]);

        Item::create($validated);

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
            'kode_barang'  => 'required|unique:items,kode_barang,' . $item->id,
            'nama_barang'  => 'required|string|max:255',
            'kategori'     => 'required|string|max:100',
            'stok'         => 'required|integer|min:0',
            'satuan'       => 'required|string|max:50',
            'harga_satuan' => 'required|numeric|min:0',
            'keterangan'   => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('items.index')->with('info', 'Barang berhasil diperbarui!');
    }

    // 6. Hapus Data Barang
    public function destroy(Item $item)
    {
        $namaBarang = $item->nama_barang;
        $item->delete();

        return redirect()->route('items.index')->with('danger', "Barang \"$namaBarang\" berhasil dihapus.");
    }
}