<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherUnlockedLevel extends Model
{
      use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teacher_unlocked_levels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'teacher_id',
        'level_id',
        'score',
        'passed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'score' => 'decimal:2',
        'passed' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the teacher that owns the unlocked level.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the level that owns the unlocked level.
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Scope a query to only include passed levels.
     */
    public function scopePassed($query)
    {
        return $query->where('passed', true);
    }

    /**
     * Scope a query to only include levels for a specific teacher.
     */
    public function scopeForTeacher($query, $teacherId)
    {
        return $query->where('teacher_id', $teacherId);
    }

    /**
     * Check if a level is unlocked for a teacher.
     */
    public static function isUnlocked($teacherId, $levelId): bool
    {
        return static::where('teacher_id', $teacherId)
                    ->where('level_id', $levelId)
                    ->exists();
    }

    /**
     * Get the highest unlocked level for a teacher.
     */
    public static function getHighestUnlockedLevel($teacherId)
    {
        return static::where('teacher_id', $teacherId)
                    ->where('passed', true)
                    ->with('level')
                    ->orderByDesc('level_id')
                    ->first();
    }
}
