<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;  削除
use Illuminate\Foundation\Auth\User;        //追記
use Illuminate\Notifications\Notifiable;    //追記

class Admin extends User
{
    // 中身は全て変更
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'kana',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
