<?php

namespace Database\Seeders;

use App\Http\Controllers\SupplierController;
use Illuminate\Database\Seeder;
use App\Models\SupplierModel;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_supplier' => 'Supplier 1',
                'alamat' => 'CTGY01',
                'telepon' => 'Food & Beverage',
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
