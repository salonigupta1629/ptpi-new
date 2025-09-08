<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function preferences()
    {
        return $this->hasMany(Preference::class, 'job_role_id');
    }
}
