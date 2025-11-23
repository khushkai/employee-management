<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject; // ✅ add this

class User extends Authenticatable implements JWTSubject // ✅ implement JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ✅ JWT required methods
    public function getJWTIdentifier()
    {
        return $this->getKey(); // primary key (usually 'id')
    }

    public function getJWTCustomClaims()
    {
        return []; // extra claims if needed, empty array for now
    }
}
