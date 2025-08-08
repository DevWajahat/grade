<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Exam extends Model
{
    protected $guarded = [];


    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function exam_hall(): BelongsTo
    {
        return $this->belongsTo(ExamHall::class);
    }

    public function questions(): HasManyThrough
    {
        return $this->hasManyThrough(Question::class, Section::class);
    }
}
