<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSection extends Model
{
    use HasFactory;

    protected $table = 'profil_sections';
    protected $fillable = ['judul', 'isi'];
}
