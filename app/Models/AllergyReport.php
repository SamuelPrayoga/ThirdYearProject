<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllergyReport extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'allergies', 'file', 'approved'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
