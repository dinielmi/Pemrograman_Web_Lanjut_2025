<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'CTGY01',
                'kategori_nama' => 'Food & Beverage',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'CTGY02',
                'kategori_nama' => 'Beauty & Health',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'CTGY03',
                'kategori_nama' => 'Home Care',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'CTGY04',
                'kategori_nama' => 'Baby & Kids',
            ],

        ];
        
        DB::table('m_kategori')->insert($data);
    }
}
