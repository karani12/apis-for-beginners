<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'category',
        'recurring',
        'interval',
        'archived',
        'completed',
        'completed_at',
        'due_date',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

  
}
