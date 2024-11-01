<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SendList extends Model
{
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
