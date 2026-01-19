<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TasksFiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size'
    ];

    public function task()
    {
        return $this->belongsTo(Tasks::class, 'task_id');
    }
}
