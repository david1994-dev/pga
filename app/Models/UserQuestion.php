<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
    protected $fillable = ['question_id', 'answer', 'user_answer'];
    protected $casts = [
        'answer' => 'array',
    ];
}
