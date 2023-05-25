<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuMakanan extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal_makan', 'menu'];

    // public function getDateAttribute()
    // {
    //     return Carbon::parse($this->attributes['tanggal_makan'])->translatedFormat('l,')
    // }
}
