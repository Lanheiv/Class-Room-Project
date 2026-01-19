<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'title_name',
        'description',
        'time_for_task',
        'max_points'
    ];

    public function class()
    {
        return $this->belongsTo(Clases::class, 'class_id');
    }

    public function files()
    {
        return $this->hasMany(TasksFiles::class, 'task_id');
    }
}

