<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // テーブル名の指定
    protected $table = 'articles';

    // マスアサインメント可能な属性
    protected $fillable = ['title', 'posted_date', 'article_contents'];

    // 日付のカスタムフォーマット
    protected $dates = ['posted_date', 'created_at', 'updated_at'];

    // デフォルトのタイムスタンプの形式を設定
    protected $dateFormat = 'Y-m-d H:i:s';

}
