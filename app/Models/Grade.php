<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable = ['name']; 

    public $timestamps = true;

    public function curriculums()
    {
        return $this->hasMany(Curriculum::class, 'grade_id');
    }

}