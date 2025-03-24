<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    protected $table = 'm_supplier';
    protected $fillable = ['supplier_kode', 'supplier_nama', 'alamat', 'telepon'];
}
