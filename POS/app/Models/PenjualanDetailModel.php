<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetailModel extends Model
{
    use HasFactory;

    protected $table = 't_penjualan_detail';
    protected $primaryKey = 'detail_id';

    // timestamps true karena ada created_at dan updated_at di tabel
    public $timestamps = true;

    protected $fillable = [
        'penjualan_id',
        'barang_id',
        'jumlah',
        'harga',
        'total', // tambahkan kolom total karena ada di tabel
    ];

    // Relasi ke tabel m_barang
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }

    // Relasi ke tabel t_penjualan
    public function penjualan()
    {
        return $this->belongsTo(PenjualanModel::class, 'penjualan_id', 'penjualan_id');
    }
}
