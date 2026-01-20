<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProfilePicture;

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

    public function classes()
    {
        return $this->belongsToMany(
            Clases::class,
            'class_users',
            'users_id',
            'clases_id'
        )->withPivot('role')->withTimestamps();
    }
    
    public function profilePictures()
    {
        return $this->hasMany(ProfilePicture::class);
    }

    public function profilePicture()
    {
        return $this->hasOne(ProfilePicture::class)->where('is_active', true);
    }
    public function submittedTasks()
    {
        return $this->hasMany(TaskSubmission::class);
    }
}
