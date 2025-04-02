<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class penjualaneeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'penjualan_id'      => 1,
                'pembeli'           => 'Newt',
                'penjualan_kode'    => 'PJLAN001',
                'penjualan_tanggal' => '2024-02-27 08:00:00',
                'user_id'           => 1,
            ],
            [
                'penjualan_id'      => 2,
                'pembeli'           => 'Thomas',
                'penjualan_kode'    => 'PJLAN002',
                'penjualan_tanggal' => '2024-02-27 08:30:00',
                'user_id'           => 1,
            ],
            [
                'penjualan_id'      => 3,
                'pembeli'           => 'Minho',
                'penjualan_kode'    => 'PJLAN003',
                'penjualan_tanggal' => '2024-02-27 09:00:00',
                'user_id'           => 1,
            ],
            [
                'penjualan_id'      => 4,
                'pembeli'           => 'Chuck',
                'penjualan_kode'    => 'PJLAN004',
                'penjualan_tanggal' => '2024-02-27 09:15:00',
                'user_id'           => 1,
            ],
            [
                'penjualan_id'      => 5,
                'pembeli'           => 'Alby',
                'penjualan_kode'    => 'PJLAN005',
                'penjualan_tanggal' => '2024-02-27 10:00:00',
                'user_id'           => 1,
            ],
            [
                'penjualan_id'      => 6,
                'pembeli'           => 'Gally',
                'penjualan_kode'    => 'PJLAN006',
                'penjualan_tanggal' => '2024-02-27 10:30:00',
                'user_id'           => 1,
            ],
            // Data tambahan
            [
                'penjualan_id'      => 7,
                'pembeli'           => 'Teresa Tie',
                'penjualan_kode'    => 'PJLAN007',
                'penjualan_tanggal' => '2024-02-27 11:00:00',
                'user_id'           => 1,
            ],
            [
                'penjualan_id'      => 8,
                'pembeli'           => 'Brenda',
                'penjualan_kode'    => 'PJLAN008',
                'penjualan_tanggal' => '2024-02-27 11:30:00',
                'user_id'           => 1,
            ],
            [
                'penjualan_id'      => 9,
                'pembeli'           => 'Aris Jones',
                'penjualan_kode'    => 'PJLAN009',
                'penjualan_tanggal' => '2024-02-27 12:00:00',
                'user_id'           => 1,
            ],
            [
                'penjualan_id'      => 10,
                'pembeli'           => 'Harriet',
                'penjualan_kode'    => 'PJLAN010',
                'penjualan_tanggal' => '2024-02-27 12:30:00',
                'user_id'           => 1,
            ],
            [
                'penjualan_id'      => 11,
                'pembeli'           => 'Jorge',
                'penjualan_kode'    => 'PJLAN011',
                'penjualan_tanggal' => '2024-02-27 13:00:00',
                'user_id'           => 1,
            ],
            [
                'penjualan_id'      => 12,
                'pembeli'           => 'Vince',
                'penjualan_kode'    => 'PJLAN012',
                'penjualan_tanggal' => '2024-02-27 13:30:00',
                'user_id'           => 1,
            ],
        ];
        
        DB::table('t_penjualan')->insert($data);
    }
}
