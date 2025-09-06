<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    // In Teacher.php
    public function classCategories()
    {
        return $this->belongsToMany(ClassCategory::class, 'teacher_class_categories', 'teacher_id', 'class_category_id');
    }

}
