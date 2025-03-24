<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class MUser extends Authenticatable
{
    protected $table = 'm_user';

    protected $fillable = [
        'nama', 'username', 'email', 'password', 'm_level_id'
    ];

    // Set password dengan bcrypt secara otomatis saat disimpan
    public function setPasswordAttribute($value)
    {
         $this->attributes['password'] = bcrypt($value);
    }

    public function level()
    {
         return $this->belongsTo(MLevel::class, 'm_level_id');
    }
}
