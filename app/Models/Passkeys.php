<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passkeys extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function application(){
        return $this->belongsTo(TeacherLevel3Choice::class,'application_id');
    }
}
