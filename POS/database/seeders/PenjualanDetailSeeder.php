<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($penjualan_id = 1; $penjualan_id <= 6; $penjualan_id++) {
            for ($barang_id = 1; $barang_id <= 12; $barang_id++) {
                $harga = match ($barang_id) {
                    1 => 20000,
                    2 => 16000,
                    3 => 7000,
                    4 => 12000,
                    5 => 20000,
                    6 => 15000,
                    7 => 25000,
                    8 => 30000,
                    9 => 15000,
                    10 => 40000,
                    11 => 60000,
                    12 => 50000,
                };

                $jumlah = rand(1, 5);
                $total = $harga * $jumlah;

                $data[] = [
                    'penjualan_id' => $penjualan_id,
                    'barang_id' => $barang_id,
                    'harga' => $harga,
                    'jumlah' => $jumlah,
                    'total' => $total,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('t_penjualan_detail')->insert($data);
    }
}
