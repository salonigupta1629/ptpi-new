<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSet extends Model
{
    protected $fillable = [
        'name',
        'description',
        'duration',
        'status',
        'type',
        'user_id',
        'level_id',
        'subject_id',
        'category_id',
        'total_marks',
        'total_question',
    ];


    public function category()
    {
        return $this->belongsTo(ClassCategory::class, 'category_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    // public function questions(){
    //     return $this->belongsTo(Question::class);
    // }

// In App\Models\ExamSet.php
public function questions()
{
    return $this->hasMany(Question::class);
    // OR if you have a different foreign key:
    // return $this->hasMany(Question::class, 'exam_set_id');
}
// public function classCategory()
// {
//     return $this->belongsTo(ClassCategory::class, 'category_id');
// }

}
