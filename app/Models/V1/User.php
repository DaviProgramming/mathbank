<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Observers\V1\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable implements JWTSubject
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'document',
        'wallets_limit'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $attributes = [
        'wallets_limit' => 2
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function wallet(): HasMany
    {
        return $this->hasMany(Wallet::class, 'user_id', 'id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
