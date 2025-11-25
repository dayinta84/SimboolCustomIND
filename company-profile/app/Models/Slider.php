<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slide';
    
    protected $fillable = [
        'image', 'title', 'subtitle'
    ];
}