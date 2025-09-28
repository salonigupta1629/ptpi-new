<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function unlockedLevels(): HasMany
    {
        return $this->hasMany(TeacherUnlockedLevel::class);
    }

    public function hasUnlockedLevel($levelId): bool
    {
        return $this->unlockedLevels()
                    ->where('level_id', $levelId)
                    ->exists();
    }

    public function hasPassedLevel($levelId): bool
    {
        $unlockedLevel = $this->unlockedLevels()
            ->where('level_id', $levelId)
            ->first();
            
        return $unlockedLevel && $unlockedLevel->passed;
    }

    public function addresses(): HasManyThrough
    {
        return $this->hasManyThrough(TeachersAddress::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }

    public function subjects(): HasManyThrough
    {
        return $this->hasManyThrough(TeacherSubject::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }

    public function skills(): HasManyThrough
    {
        return $this->hasManyThrough(TeacherSkill::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }

    public function qualifications(): HasManyThrough
    {
        return $this->hasManyThrough(TeacherQualification::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }

    public function experiences(): HasManyThrough
    {
        return $this->hasManyThrough(TeacherExperiences::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }

    public function classCategories(): BelongsToMany
    {
        return $this->belongsToMany(
            ClassCategory::class, 
            'teacher_class_categories', 
            'user_id', 
            'class_category_id'
        )->withTimestamps();
    }

    public function getSubjectsTextAttribute()
    {
        // For HasManyThrough relationship, access the subject names differently
        $subjectNames = $this->subjects->pluck('subject.name')->filter()->unique();
        return $subjectNames->isNotEmpty() ? $subjectNames->join(', ') : 'Not specified';
    }

    public function getGradeLevelsTextAttribute()
    {
        return $this->classCategories->pluck('name')->join(', ') ?: 'Not specified';
    }

    public function getInitialsAttribute()
    {
        $name = $this->user->name ?? '';
        $names = explode(' ', $name);
        $initials = '';
        
        if (count($names) >= 2) {
            $initials = strtoupper(substr($names[0], 0, 1) . substr($names[count($names)-1], 0, 1));
        } elseif (count($names) == 1) {
            $initials = strtoupper(substr($names[0], 0, 2));
        }
        
        return $initials;
    }

    public function getExperienceTextAttribute()
    {
        $years = $this->experience_years ?? 0;
        return $years . ' year' . ($years != 1 ? 's' : '') . ' experience';
    }
}