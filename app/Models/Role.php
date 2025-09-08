<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $guarded = [];

    public function preferences()
    {
        return $this->hasMany(Preference::class, 'job_role_id');
    }
     public function experiences(): HasMany
    {
        return $this->hasMany(TeacherExperiences::class);
    }
}
