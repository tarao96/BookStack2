<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'file_name', 'point1', 'point2', 'point3', 'point4', 'point5', 'thoughts'
    ];

    protected static function boot()
    {
        parent::boot();

        // 保存時user_idをログインユーザーに設定
        self::saving(function($post) {
            $post->user_id = \Auth::id();
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
