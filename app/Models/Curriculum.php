<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    protected $fillable = [
        'title',
        'description',
        'video_url',
        'grade_id',
        'delivery_start',
        'delivery_end',
    ];

    protected $dates = [
        'delivery_start',
        'delivery_end',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function progresses()
    {
        return $this->hasMany(CurriculumProgress::class);
    }
}