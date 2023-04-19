<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'author_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function author () {
        return $this->belongsTo(Author::class);
    }

    public function roles () {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole (string $roleSlug) {

        return $this
            ->roles
            ->contains('slug', $roleSlug);
    }

    public function addRole (string $roleSlug) {

        $role = Role::where('slug', $roleSlug)->first();

        return $this
            ->roles()
            ->attach($role);
    }

    public function removeRole (string $roleSlug) {

        $role = Role::where('slug', $roleSlug)->first();

        return $this
            ->roles()
            ->detach($role);
    }

}
