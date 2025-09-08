<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Teacher extends Model
{
    protected $guarded = [];
        public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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

    public function classCategory(): BelongsTo
    {
        return $this->belongsTo(ClassCategory::class, 'class_categories_id');
    }


}
