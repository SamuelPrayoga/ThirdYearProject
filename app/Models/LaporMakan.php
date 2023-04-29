<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LaporMakan extends Model
{
    use HasFactory;

    protected $table = 'laporan_makanan';

    protected $fillable = [
        'user_id',
        'tanggal',
        'waktu_makan',
        'is_makan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
