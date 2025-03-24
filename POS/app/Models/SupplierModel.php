<?php

namespace App\Models;

use Database\Seeders\StokSeeder;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    protected $table = 'm_supplier';

    protected $fillable = ['supplier_kode', 'supplier_nama', 'alamat', 'telepon'];

    public function stok()
    {
        return $this->hasMany(StokSeeder::class, 'supplier_id');
    }

}
