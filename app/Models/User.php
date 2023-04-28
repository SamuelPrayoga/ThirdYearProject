<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN_ROLE_ID = 1;
    const KEASRAMAAN_ROLE_ID = 2;
    const USER_ROLE_ID = 3;
    const PENGELOLA_ROLE_ID = 4;
    const DEPKEBDIS_ROLE_ID = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nim',
        'angkatan',
        'asrama',
        'name',
        'prodi',
        'email',
        'password',
        'role_id', //3
        'position_id', //1
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function scopeOnlyEmployees($query)
    {
        return $query->where('role_id', self::USER_ROLE_ID);
    }

    public function isAdmin()
    {
        return $this->role_id === self::ADMIN_ROLE_ID;
    }

    public function isKeasramaan()
    {
        return $this->role_id === self::KEASRAMAAN_ROLE_ID; //keasramaan
    }

    public function isUser()
    {
        return $this->role_id === self::USER_ROLE_ID;
    }
    public function isPengelola()
    {
        return $this->role_id === self::PENGELOLA_ROLE_ID;
    }

    public function isDepkebdis()
    {
        return $this->role_id === self::DEPKEBDIS_ROLE_ID;
    }

    public function feedback() {
        return $this->hasMany(Feedback::class);
    }
    public function barang() {
        return $this->hasMany(barang::class);
    }

    public function allergyReports()
    {
        return $this->hasMany(AllergyReport::class);
    }


}
