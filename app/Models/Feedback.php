<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nim', 'tanggal_ulasan', 'nilai_rating', 'subjek_ulasan', 'deskripsi','file'];
}
