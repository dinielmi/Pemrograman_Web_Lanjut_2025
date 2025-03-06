<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        $jumlah_transaksi = 10;  // Total transaksi penjualan
        
        for ($i = 1; $i <= $jumlah_transaksi; $i++) {
            for ($barang_id = 1; $barang_id <= 3; $barang_id++) {
                $data[] = [
                    'harga' => rand(100000, 2000000), // Harga acak
                    'jumlah' => rand(1, 5),           // Jumlah acak
                    'penjualan_id' => $i,
                    'barang_id' => $barang_id,
                ];
            }
        }

        DB::table('t_penjualan_detail')->insert($data);
    }
}

