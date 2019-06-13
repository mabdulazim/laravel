<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $guard_name = 'web';

    protected $fillable = [
        'name', 
        'email', 
        'mobile',
        'password',
        'type',
        'is_blocked',
        'reset_code',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
        'permissions',
    ];

    protected $appends = [
        'user_permissions',
    ];

    public function getUserPermissionsAttribute()
    {
        return $this->permissions->pluck('name')->toArray();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function passwordReset()
    {
        return $this->hasOne(PasswordReset::class, 'email', 'email');
    }
}
