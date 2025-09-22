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

      // New method to get question text in specified language
    public function getQuestionText($language = 'english')
    {
        if ($language === 'hindi' && isset($this->translations['hi']['question_text'])) {
            return $this->translations['hi']['question_text'] ?: $this->question_text;
        }
        return $this->question_text;
    }
    
    // New method to get options in specified language
  public function getOptions($language = 'english')
{
    if ($language === 'hindi' && isset($this->translations['hi']['options'])) {
        $hindiOptions = $this->translations['hi']['options'];
        // Ensure we return an array, not JSON string
        return is_array($hindiOptions) ? $hindiOptions : json_decode($hindiOptions, true) ?? $this->options;
    }
    
    // Ensure we return an array for English options too
    return is_array($this->options) ? $this->options : json_decode($this->options, true);
}
    
    // New method to get correct option in specified language
    public function getCorrectOption($language = 'english')
    {
        if ($language === 'hindi' && isset($this->translations['hi']['correct_option'])) {
            return $this->translations['hi']['correct_option'] ?: $this->correct_option;
        }
        return $this->correct_option;
    }

}
