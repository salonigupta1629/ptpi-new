<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherLevel3Choice extends Model
{
protected $fillable = ['user_id', 'level_id', 'mode', 'center_id', 'pincode'];
    
    public function user() { return $this->belongsTo(User::class); }
    public function level() { return $this->belongsTo(Level::class); }
    public function center() { return $this->belongsTo(ExamCenter::class); }
}
