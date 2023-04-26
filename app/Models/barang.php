<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'kategori', 'name', 'description', 'image'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
