<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'stok_jumlah' => 100,
                'stok_tanggal' => '2024-02-27 08:00:00',
                'barang_id' => 1,
                'supplier_id' => 1,
                'user_id' => 1,
            ],
            [
                'stok_jumlah' => 120,
                'stok_tanggal' => '2024-02-27 08:00:00',
                'barang_id' => 2,
                'supplier_id' => 2,
                'user_id' => 1,
            ],
            [
                'stok_jumlah' => 10,
                'stok_tanggal' => '2024-02-27 08:00:00',
                'barang_id' => 3,
                'supplier_id' => 3,
                'user_id' => 1,
            ],
            [
                'stok_jumlah' => 30,
                'stok_tanggal' => '2024-02-27 08:00:00',
                'barang_id' => 4,
                'supplier_id' => 4,
                'user_id' => 1,
            ],
            [
                'stok_jumlah' => 50,
                'stok_tanggal' => '2024-02-27 08:00:00',
                'barang_id' => 5,
                'supplier_id' => 5,
                'user_id' => 1,
            ],
            [
                'stok_jumlah' => 75,
                'stok_tanggal' => '2024-02-27 08:00:00',
                'barang_id' => 6,
                'supplier_id' => 1,
                'user_id' => 1,
            ],
            [
                'stok_jumlah' => 200,
                'stok_tanggal' => '2024-02-27 08:00:00',
                'barang_id' => 7,
                'supplier_id' => 2,
                'user_id' => 1,
            ],
            [
                'stok_jumlah' => 300,
                'stok_tanggal' => '2024-02-27 08:00:00',
                'barang_id' => 8,
                'supplier_id' => 3,
                'user_id' => 1,
            ],
            [
                'stok_jumlah' => 45,
                'stok_tanggal' => '2024-02-27 08:00:00',
                'barang_id' => 9,
                'supplier_id' => 4,
                'user_id' => 1,
            ],
            [
                'stok_jumlah' => 60,
                'stok_tanggal' => '2024-02-27 08:00:00',
                'barang_id' => 10,
                'supplier_id' => 5,
                'user_id' => 1,
            ],
        ];
        
        DB::table('t_stok')->insert($data);
    }
}