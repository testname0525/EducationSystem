<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryTime extends Model
{
    use HasFactory;
    protected $casts = [
        'delivery_from' => 'datetime',
        'delivery_to' => 'datetime',
    ];

    protected $table = 'delivery_times';

    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }
}
