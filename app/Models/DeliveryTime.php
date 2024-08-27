<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculum_id',
        'delivery_from',
        'delivery_to',
    ];

    protected $casts = [
        'delivery_from' => 'datetime',
        'delivery_to' => 'datetime',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}