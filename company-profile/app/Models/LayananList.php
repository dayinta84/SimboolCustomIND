<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananList extends Model
{
    protected $table = 'layanan_list';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
    ];
}