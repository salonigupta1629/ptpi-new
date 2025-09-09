<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $guarded = [];
     public function jobRole()
    {
        return $this->belongsTo(Role::class, 'job_role_id');
    }
    public function jobType()
    {
        return $this->belongsTo(TeacherJobType::class, 'teacher_job_type_id');
    }
}
