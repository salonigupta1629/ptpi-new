<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InterviewSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_attempt_id',
      'teacher_id',
        'scheduled_at',
            'requested_at',
        'status',
        'meeting_link',
      'teacher_notes', 
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
          'requested_at' => 'datetime'
    ];

    public function examAttempt(): BelongsTo
    {
        return $this->belongsTo(ExamAttempt::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

        public function user()
    {
        return $this->through('teacher')->has('user');
    }
    
     public function teacherUser()
    {
        return $this->hasOneThrough(
            User::class,
            Teacher::class,
            'id', // Foreign key on teachers table
            'id', // Foreign key on users table
            'teacher_id', // Local key on interview_schedules table
            'user_id' // Local key on teachers table
        );
    }
    
}