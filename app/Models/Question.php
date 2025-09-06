<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'exam_set_id',
        'question_text',
        'options',
        'correct_option',
        'language',
        'solution',
        'translations',
    ];

    protected $casts = [
'options' => 'array',
   'translations' => 'array', 
    ];

    public function examSet(){
        return $this->belongsTo(ExamSet::class);
    }
}
