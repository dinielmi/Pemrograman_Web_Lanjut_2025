<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run()
    {

        $data = [
            'Food & Beverage' => [
                [
                    'nama_product' => 'Nasi Goreng Spesial',
                    'stok'         => 100,
                    'harga'        => 15000,
                ],
                [
                    'nama_product' => 'Mie Ayam',
                    'stok'         => 80,
                    'harga'        => 12000,
                ],
                [
                    'nama_product' => 'Es Teh Manis',
                    'stok'         => 150,
                    'harga'        => 5000,
                ],
            ],
            'Beauty & Health' => [
                [
                    'nama_product' => 'Sabun Mandi',
                    'stok'         => 200,
                    'harga'        => 8000,
                ],
                [
                    'nama_product' => 'Shampoo',
                    'stok'         => 120,
                    'harga'        => 15000,
                ],
                [
                    'nama_product' => 'Pasta Gigi',
                    'stok'         => 180,
                    'harga'        => 10000,
                ],
            ],
            'Home Care' => [
                [
                    'nama_product' => 'Detergen',
                    'stok'         => 100,
                    'harga'        => 20000,
                ],
                [
                    'nama_product' => 'Pembersih Lantai',
                    'stok'         => 80,
                    'harga'        => 25000,
                ],
                [
                    'nama_product' => 'Pewangi Ruangan',
                    'stok'         => 150,
                    'harga'        => 12000,
                ],
            ],
            'Baby & Kids' => [
                [
                    'nama_product' => 'Popok Bayi',
                    'stok'         => 200,
                    'harga'        => 30000,
                ],
                [
                    'nama_product' => 'Susu Formula',
                    'stok'         => 100,
                    'harga'        => 50000,
                ],
                [
                    'nama_product' => 'Mainan Edukatif',
                    'stok'         => 80,
                    'harga'        => 40000,
                ],
            ],
        ];

        DB::table('m_barang')->insert($data);

        
    }
}
        