<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SupplierSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'supplier_kode' => 'SUP001',
                'supplier_nama' => 'Supplier A',
                'alamat' => 'Jl. Merdeka No. 1, Jakarta',
                'telepon' => '0812345678',
            ],
            [
               'supplier_kode' => 'SUP002',
                'supplier_nama' => 'Supplier b',
                'alamat' => 'Jl. Pahlawan No. 5, Surabaya',
                'telepon' => '0890765834',
            ],
            [
              'supplier_kode' => 'SUP003',
                'supplier_nama' => 'Supplier C',
                'alamat' => 'Jl. Raya No. 10, Bandung',
                'telepon'       => null,
            ],
            [
              'supplier_kode' => 'SUP004',
                'supplier_nama' => 'Supplier D',
                'alamat' => 'Jl. Sejahtera No. 8, Yogyakarta',
                'telepon' => '0800708453',
            ],
            [
                'supplier_kode' => 'SUP005',
                  'supplier_nama' => 'Supplier E',
                  'alamat' => 'Jl. Sentosa No. 3, Bali',
                  'telepon'       => null,
              ],

        ];
        
        DB::table('m_supplier')->insert($data);
    }
}
