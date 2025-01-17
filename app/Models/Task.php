<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'project_id',
        'assigned_to'
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // タスクが属するプロジェクト
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // タスクの担当者
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
