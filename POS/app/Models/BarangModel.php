<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangmodel extends Model
{
    protected $table = 'm_barang';
    protected $fillable = ['nama_barang', 'stok', 'harga', 'm_kategori_id', 'm_supplier_id'];

    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'm_kategori_id');
    }

    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'm_supplier_id');
    }
}
    