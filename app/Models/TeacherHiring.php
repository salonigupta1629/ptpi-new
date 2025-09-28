<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherHiring extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'recruiter_id',
        'status',
        'request_date'
    ];

    protected $casts = [
        'request_date' => 'date',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function recruiter()
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            self::STATUS_APPROVED => 'green',
            self::STATUS_REJECTED => 'red',
            default => 'yellow'
        };
    }

    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            self::STATUS_APPROVED => 'bg-green-100 text-green-800',
            self::STATUS_REJECTED => 'bg-red-100 text-red-800',
            default => 'bg-yellow-100 text-yellow-800'
        };
    }
}