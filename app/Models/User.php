<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(TeachersAddress::class);
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(TeacherSubject::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(TeacherSkill::class);
    }

    public function qualifications(): HasMany
    {
        return $this->hasMany(TeacherQualification::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(TeacherExperiences::class);
    }

    public function classCategories(): HasMany
    {
        return $this->hasMany(TeacherClassCategory::class);
    }
}
