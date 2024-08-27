<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'video_url',
        'grade_id',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function progress()
    {
        return $this->hasMany(CurriculumProgress::class, 'curriculums_id');
    }

    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class);
    }
}