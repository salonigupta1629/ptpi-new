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
    ];

    protected $casts = [
'options' => 'array',
'correct_option' => 'integer',
    ];

    public function examSet(){
        return $this->belongsTo(ExamSet::class);
    }
}
