<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SendList extends Model
{
    protected $primaryKey = 'uuid'; // 主キーをuuidに指定
    public $incrementing = false; // 自動インクリメントを無効化
    protected $keyType = 'string'; // キーの型をstringに指定
    
    protected $fillable = [
        'name',
        'user_id',
        'postcard_title',
        'postcard_sentence',
        'postcard_end',
    ];

    protected static function boot()
    {
        parent::boot();

        // レコード作成時にUUIDを自動生成
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
