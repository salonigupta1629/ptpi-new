<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherClassCategory extends Model
{
    protected $guarded = [];

    public function classCategory () {
        return $this->belongsTo(ClassCategory::class, 'class_category_id');
    }
}
