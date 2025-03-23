<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

   
    protected $table = 'm_barang'; // Nama tabel di database

    protected $primaryKey = 'barang_id'; // Primary Key

    public $timestamps = false; // Jika tabel tidak punya created_at & updated_at

    protected $fillable = [
        'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

}
