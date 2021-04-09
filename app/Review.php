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
    
    /**
     * 絞り込み・キーワード検索
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array
     * @return \Illuminate\Database\Eloquent\Builder
     */
     public function scopeSearch($query, $request, $shop_ids)
    {
        $prefecture = $request->input('prefecture');
        $keywords = $request->input('keyword');
        
        // 店舗情報による絞り込み
        if ($prefecture != '全国' && !empty($shop_ids)) {
            $query->whereIn('shop_id', $shop_ids);
        }
        
        // キーワード検索
        if (!empty($keywords)) {
            foreach ($keywords as $keyword) {
                $query->where(function($query) use($keyword){
                    $query->Where('menu', 'like', '%' . $keyword . '%')
                        ->orWhere('content', 'like', '%' . $keyword . '%');
                });
            }
        }
        
        return $query;
    }
    
}
