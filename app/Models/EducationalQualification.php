<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationalQualification extends Model
{
     protected $fillable = ['name','description'];
     public function teachers(): HasMany
    {
        return $this->hasMany(TeacherQualification::class, 'qualification_id');
    }
}
