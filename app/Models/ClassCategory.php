<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassCategory extends Model
{
    protected $table= 'class_categories';
    protected $fillable = ['name'];
}
