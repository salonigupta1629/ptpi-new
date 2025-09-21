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

public function hasPassedLevel($levelId): bool
{
    $unlockedLevel = $this->unlockedLevels()
        ->where('level_id', $levelId)
        ->first();
        
    return $unlockedLevel && $unlockedLevel->passed;
}

}
