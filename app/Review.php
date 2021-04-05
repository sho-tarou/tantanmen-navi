<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'menu', 'satisfaction', 'image_url', 'content', 'user_id', 'shop_id',  
    ];
    
    /**
     * このレビューを所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * このレビューをお気に入り中のユーザ。（ Userモデルとの関係を定義）
     */
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'review_id', 'user_id')->withTimestamps();
    }
    
    /**
     * このレビューが評価した店舗。（ Shopモデルとの関係を定義）
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    
}
