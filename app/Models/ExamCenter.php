<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamCenter extends Model
{
     use HasFactory;

    protected $fillable = [
        'center_name',
        'area',
        'pincode',
        'city',
        'state',
        'manager_id',
        'inactive'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function examCenters()
{
    return $this->hasMany(ExamCenter::class, 'manager_id');
}
}