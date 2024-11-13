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
        'always_delivery_flg',
        'grade_id',
    ];

    protected $casts = [
        'always_delivery_flg' => 'boolean',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class);
    }

    public function progresses()
    {
        return $this->hasMany(CurriculumProgress::class);
    }
}