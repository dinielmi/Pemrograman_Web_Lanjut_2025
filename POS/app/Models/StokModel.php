<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 't_stok';

    protected $fillable = ['barang_id', 'supplier_id', 'qty_in', 'qty_out', 'tanggal'];

    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id');
    }

    public function product()
    {
        return $this->belongsTo(BarangModel::class, 'product_id');
    }
}
