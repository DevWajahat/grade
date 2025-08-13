<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $guarded = [];

    public function userExamAttempt()
    {
        return $this->belongsTo(UserExamAttempt::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
