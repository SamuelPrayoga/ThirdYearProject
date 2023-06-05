<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuMakanan extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal_makan', 'menu_pagi','menu_siang','menu_malam','foto1','foto2', 'foto3'];

    // public function getDateAttribute()
    // {
    //     return Carbon::parse($this->attributes['tanggal_makan'])->translatedFormat('l,')
    // }
}
