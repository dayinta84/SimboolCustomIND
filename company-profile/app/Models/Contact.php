<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'alamat',
        'whatsapp',
        'map',
        'gambar',
    ];

    protected $casts = [
        'whatsapp' => 'array',
    ];
}