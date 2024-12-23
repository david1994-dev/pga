<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'answers', 'created_by'];
    protected $casts = [
        'answers' => 'array',
    ];

    public function userQuestions()
    {
        return $this->hasMany(UserQuestion::class);
    }

    public function createdBy() //join created_by with id on users table
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
