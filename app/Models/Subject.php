<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['subject_name','subject_description','category_id'];

    public function category(){
        return $this->belongsTo(ClassCategory::class, 'category_id');
    }

      public function questionManagers()
    {
        return $this->hasMany(QuestionManager::class);
    }
}
