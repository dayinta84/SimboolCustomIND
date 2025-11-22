<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'why_1_title', 'why_1_desc',
        'why_2_title', 'why_2_desc',
        'why_3_title', 'why_3_desc',
    ];
}