<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'kode_barang'  => 'ATK-001',
                'nama_barang'  => 'Kertas A4 80gr',
                'kategori'     => 'ATK',
                'stok'         => 50,
                'satuan'       => 'Rim',
                'harga_satuan' => 45000,
                'keterangan'   => 'Kertas HVS untuk keperluan kantor',
            ],
            [
                'kode_barang'  => 'ATK-002',
                'nama_barang'  => 'Pulpen Pilot G2',
                'kategori'     => 'ATK',
                'stok'         => 120,
                'satuan'       => 'Pcs',
                'harga_satuan' => 8500,
                'keterangan'   => null,
            ],
            [
                'kode_barang'  => 'ELK-001',
                'nama_barang'  => 'Baterai AA Alkaline',
                'kategori'     => 'Elektronik',
                'stok'         => 200,
                'satuan'       => 'Pcs',
                'harga_satuan' => 7000,
                'keterangan'   => 'Merk Energizer',
            ],
            [
                'kode_barang'  => 'ELK-002',
                'nama_barang'  => 'Kabel USB Type-C 1m',
                'kategori'     => 'Elektronik',
                'stok'         => 30,
                'satuan'       => 'Pcs',
                'harga_satuan' => 35000,
                'keterangan'   => null,
            ],
            [
                'kode_barang'  => 'BBK-001',
                'nama_barang'  => 'Kardus Packing 30x20x15',
                'kategori'     => 'Bahan Baku',
                'stok'         => 300,
                'satuan'       => 'Box',
                'harga_satuan' => 3500,
                'keterangan'   => 'Kardus single wall',
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
