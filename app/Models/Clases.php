<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clases extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'subject',
        'description',
        'access_code',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'class_users', 'clases_id', 'users_id')
                    ->withPivot('role')->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'class_id'); 
    }
}

