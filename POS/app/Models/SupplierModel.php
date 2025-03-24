<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSupplier extends Model
{
    protected $table = 'm_supplier';
    protected $fillable = ['nama_supplier', 'alamat', 'telepon'];
}
