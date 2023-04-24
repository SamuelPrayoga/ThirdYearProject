<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
use App\Models\User;

class IzinBermalam extends Model
{
    use HasFactory;

    protected $table = 'izin_bermalam';

    protected $fillable = [
        'attendance_id',
        'user_id',
        'keberangkatan',
        'kedatangan',
        'alasan',
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
