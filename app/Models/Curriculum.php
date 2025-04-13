<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
    
    /**
     * 視聴可能かチェック（常時公開または配信期間内）
     */
    public function isAvailable()
    {
        // 常時公開の場合
        if ($this->always_delivery_flg) {
            return true;
        }
        
        // 現在の日時
        $now = Carbon::now();
        
        // 配信期間内かチェック
        foreach ($this->deliveryTimes as $deliveryTime) {
            if ($now->between($deliveryTime->delivery_from, $deliveryTime->delivery_to)) {
                return true;
            }
        }
        
        return false;
    }
}