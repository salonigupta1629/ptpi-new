<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ExamAttempt extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_set_id',
        'status',
        'language',
        'score',
        'started_at',
        'ended_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'score' => 'decimal:2',
    ];

    /**
     * Get the user that owns the exam attempt.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the exam set that owns the exam attempt.
     */
    public function examSet(): BelongsTo
    {
        return $this->belongsTo(ExamSet::class);
    }

    /**
     * Get the user answers for the exam attempt.
     */
    public function userAnswers(): HasMany
    {
        return $this->hasMany(UserAnswer::class);
    }
}