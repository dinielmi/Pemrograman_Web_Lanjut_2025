<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run()
    {

        $data = [
            [
                'barang_kode' => 'BRG001',
                'barang_nama' => 'Nasi Goreng Spesial',
                'harga_beli'  => 15000,
                'harga_jual'  => 20000,
                'kategori_id' => 1, // Ensure this ID exists in the m_kategori table
            ],
            [
                'barang_kode' => 'BRG002',
                'barang_nama' => 'Mie Ayam',
                'harga_beli'  => 12000,
                'harga_jual'  => 16000,
                'kategori_id' => 1,
            ],
            [
                'barang_kode' => 'BRG003',
                'barang_nama' => 'Es Teh Manis',
                'harga_beli'  => 5000,
                'harga_jual'  => 7000,
                'kategori_id' => 1,
            ],
            [
                'barang_kode' => 'BRG004',
                'barang_nama' => 'Sabun Mandi',
                'harga_beli'  => 8000,
                'harga_jual'  => 12000,
                'kategori_id' => 2, // Ensure this ID exists in the m_kategori table
            ],
            [
                'barang_kode' => 'BRG005',
                'barang_nama' => 'Shampoo',
                'harga_beli'  => 15000,
                'harga_jual'  => 20000,
                'kategori_id' => 2,
            ],
            [
                'barang_kode' => 'BRG006',
                'barang_nama' => 'Pasta Gigi',
                'harga_beli'  => 10000,
                'harga_jual'  => 15000,
                'kategori_id' => 2,
            ],
            [
                'barang_kode' => 'BRG007',
                'barang_nama' => 'Detergen',
                'harga_beli'  => 20000,
                'harga_jual'  => 25000,
                'kategori_id' => 3, // Ensure this ID exists in the m_kategori table
            ],
            [
                'barang_kode' => 'BRG008',
                'barang_nama' => 'Pembersih Lantai',
                'harga_beli'  => 25000,
                'harga_jual'  => 30000,
                'kategori_id' => 3,
            ],
            [
                'barang_kode' => 'BRG009',
                'barang_nama' => 'Pewangi Ruangan',
                'harga_beli'  => 12000,
                'harga_jual'  => 15000,
                'kategori_id' => 3,
            ],
            [
                'barang_kode' => 'BRG010',
                'barang_nama' => 'Popok Bayi',
                'harga_beli'  => 30000,
                'harga_jual'  => 40000,
                'kategori_id' => 4, // Ensure this ID exists in the m_kategori table
            ],
            [
                'barang_kode' => 'BRG011',
                'barang_nama' => 'Susu Formula',
                'harga_beli'  => 50000,
                'harga_jual'  => 60000,
                'kategori_id' => 4,
            ],
            [
                'barang_k ode' => 'BRG012',
                'barang_nama' => 'Mainan Edukatif',
                'harga_beli'  => 40000,
                'harga_jual'  => 50000,
                'kategori_id' => 4,
            ],
        ];

        DB::table('m_barang')->insert($data);

        
    }
}
        