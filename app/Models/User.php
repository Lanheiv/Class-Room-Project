<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'full_name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship: user belongs to many classes
    public function classes()
    {
        return $this->belongsToMany(
            Clases::class,   // model
            'class_users',   // pivot table
            'users_id',      // this model foreign key in pivot
            'clases_id'      // related model foreign key in pivot
        )->withPivot('role')->withTimestamps();
    }
}

