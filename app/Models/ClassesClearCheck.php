<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassesClearCheck extends Model
{
    use HasFactory;
    // テーブル名を指定
    protected $table = 'classes_clear_checks';

    protected $fillable = [
        'user_id',
        'curriculum_id',
        'clear_flg',
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

}
