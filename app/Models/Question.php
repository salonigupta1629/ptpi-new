<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   protected $guarded = [];

    protected $casts = [
        'options' => 'array',
        'translations' => 'array',
    ];

    public function examSet(){
        return $this->belongsTo(ExamSet::class);
    }
    public function userAnswers(){
        return $this->hasMany(UserAnswer::class,'question_id');
    }
}
