<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'subject_id',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ClassCategory::class, 'category_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
