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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }
    
    public function permissions() {
        
        return $this->belongsToMany(Permission::class);
    }

    public function hasRole(string $role) {

        return $this
            ->roles
            ->contains('slug', $role);
    }

    public function hasPermission($permission) {
        
        return $this
            ->permissions
            ->contains('slug', $permission);
    }
}
