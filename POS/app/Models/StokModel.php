<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StokModel extends Model
{
    use HasFactory;

    protected $table = 't_stok';
    protected $primaryKey = 'stok_id';

    protected $fillable = [
        'stok_jumlah',
        'stok_tanggal',
        'barang_id',
        'supplier_id',
    ];

    public function barang() {
        return $this->belongsTo(BarangModel::class, 'barang_id');
    }
    
    public function supplier() {
        return $this->belongsTo(SupplierModel::class, 'supplier_id');
    }
    
}
