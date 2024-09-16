<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumProgress extends Model
{
    use HasFactory;

    // テーブル名を指定
    protected $table = 'curriculum_progress';

    // 代入可能な属性
    protected $fillable = [
        'user_id',
        'curriculum_id',
        'clear_flg',
    ];

    // ユーザーとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // カリキュラムとのリレーション
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
