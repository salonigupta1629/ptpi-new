<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassCategory extends Model
{
    protected $table= 'class_categories';
    protected $fillable = ['name'];


    public function subjects()
    {
        return $this->hasMany(Subject::class, 'category_id');
    }

    public function questionManagers()
    {
        return $this->hasMany(QuestionManager::class);
    }
      public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class, 'class_categories_id');
    }
}
