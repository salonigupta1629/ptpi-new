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
];

// In your status dropdown in the Blade file, change:
// <option value="archieved">Archieved</option>
// to:
// <option value="archived">Archived</option>

    public function category(){
        return $this->belongsTo(ClassCategory::class,'category_id');
    }

    public function level(){
        return $this->belongsTo(Level::class,'level_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function subject()
{
    return $this->belongsTo(Subject::class);
}


}
