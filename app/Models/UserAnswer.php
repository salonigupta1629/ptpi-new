<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAnswer extends Model
{
    protected $guarded = [];

  /**
     * Get the exam attempt that owns the user answer.
     */
    public function examAttempt(): BelongsTo
    {
        return $this->belongsTo(ExamAttempt::class);
    }

    /**
     * Get the question that owns the user answer.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
