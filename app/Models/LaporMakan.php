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
        'tanggal_berangkat',
        'jam_berangkat',
        'tanggal_kembali',
        'jam_kembali',
        'is_makan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
