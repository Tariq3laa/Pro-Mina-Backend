<?php

namespace Modules\Website\User\Entities;

use Illuminate\Support\Facades\Hash;
use Modules\Website\User\Entities\Job;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable implements JWTSubject
{
    protected $guarded = ['id'];
    protected $casts = ['status' => 'boolean'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value ? Hash::make($value) : $this->attributes['password'];
    }

    /**
     * Get the current client albums
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
