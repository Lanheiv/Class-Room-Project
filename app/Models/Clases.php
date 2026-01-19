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

    // Relationship: class has many users
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'class_users',
            'clases_id',
            'users_id'
        )->withPivot('role')->withTimestamps();
    }
}
