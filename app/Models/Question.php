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
//   public function getOptions($language = 'english')
// {
//     if ($language === 'hindi' && isset($this->translations['hi']['options'])) {
//         $hindiOptions = $this->translations['hi']['options'];
//         // Ensure we return an array, not JSON string
//         return is_array($hindiOptions) ? $hindiOptions : json_decode($hindiOptions, true) ?? $this->options;
//     }
    
    // Ensure we return an array for English options too
//     return is_array($this->options) ? $this->options : json_decode($this->options, true);
// }
    
    // New method to get correct option in specified language
    // public function getCorrectOption($language = 'english')
    // {
    //     if ($language === 'hindi' && isset($this->translations['hi']['correct_option'])) {
    //         return $this->translations['hi']['correct_option'] ?: $this->correct_option;
    //     }
    //     return $this->correct_option;
    // }






    // Updated method to get options in specified language
public function getOptions($language = 'english')
{
    // Get base options array
    $options = is_array($this->options) ? $this->options : json_decode($this->options, true) ?? [];
    
    if ($language === 'hindi' && isset($this->translations['hi']['options'])) {
        $hindiOptions = $this->translations['hi']['options'];
        // Ensure we return an array
        return is_array($hindiOptions) ? $hindiOptions : (json_decode($hindiOptions, true) ?? $options);
    }
    
    return $options;
}

// NEW: Method to get correct option letter (A, B, C, D)
public function getCorrectOptionLetter($language = 'english')
{
    $options = $this->getOptions($language);
    $correctOptionText = $this->getCorrectOptionText($language);
    
    // Find the index of correct option in the options array
    $correctIndex = array_search($correctOptionText, $options);
    
    if ($correctIndex !== false) {
        return chr(65 + $correctIndex); // Convert to A, B, C, D
    }
    
    return $this->correct_option; // Fallback to stored value
}

// NEW: Method to get correct option text
public function getCorrectOptionText($language = 'english')
{
    if ($language === 'hindi' && isset($this->translations['hi']['correct_option'])) {
        return $this->translations['hi']['correct_option'] ?: $this->getEnglishCorrectOptionText();
    }
    
    return $this->getEnglishCorrectOptionText();
}

// NEW: Method to get English correct option text
private function getEnglishCorrectOptionText()
{
    $options = is_array($this->options) ? $this->options : json_decode($this->options, true) ?? [];
    
    // Handle different correct_option formats
    if (str_starts_with($this->correct_option, 'option')) {
        $index = (int) str_replace('option', '', $this->correct_option) - 1;
        return $options[$index] ?? $this->correct_option;
    }
    
    return $this->correct_option;
}

// Keep this for backward compatibility but make it return the LETTER
// public function getCorrectOption($language = 'english')
// {
//     return $this->getCorrectOptionLetter($language);
// }
  // **FIXED**: Convert "option1" → "A", "option4" → "D"
    public function getCorrectOption($language = 'english')
    {
        // If it's already A, B, C, D, return as is
        if (in_array($this->correct_option, ['A', 'B', 'C', 'D'])) {
            return $this->correct_option;
        }
        
        // Convert "option1", "option2", "option3", "option4" to A, B, C, D
        if (preg_match('/option(\d+)/', $this->correct_option, $matches)) {
            $index = (int)$matches[1] - 1; // option1 → 0, option4 → 3
            return chr(65 + $index); // 0→A, 1→B, 2→C, 3→D
        }
        
        return $this->correct_option;
    }

}
