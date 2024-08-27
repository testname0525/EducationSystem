<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumClearCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'grade_id',
        'clear_flg',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}