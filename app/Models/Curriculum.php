<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Curriculum extends Model
{
    protected $table = 'curriculums';
    
    use HasFactory;

    public function deliveryTimes(): HasMany
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
