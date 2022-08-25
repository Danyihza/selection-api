<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telp',
        'no_telp_ortu',
        'isAccepted'
    ];

    protected $casts = [
        'isAccepted' => 'int'
    ];
}
