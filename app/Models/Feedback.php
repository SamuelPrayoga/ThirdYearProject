<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'value_rating', 'subject_review', 'description', 'file'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
