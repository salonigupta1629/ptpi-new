<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherClassCategory extends Model
{
    protected $guarded = [];
     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function classCategory(): BelongsTo
    {
        return $this->belongsTo(ClassCategory::class);
    }

}
