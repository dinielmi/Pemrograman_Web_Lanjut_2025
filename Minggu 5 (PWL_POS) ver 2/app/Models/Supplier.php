<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'm_supplier';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_supplier', 'alamat', 'telepon'];

    public $timestamps = false;
}
