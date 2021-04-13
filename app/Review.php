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
     * このレビューにつけられたタグ。（ Tagモデルとの関係を定義）
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'review_tag', 'review_id', 'tag_id')->withTimestamps();
    }
    
    /**
     * $tagIdで指定されたタグをつける。
     *
     * @param  int  $tagId
     * @return bool
     */
    public function tag($tagId)
    {
        // すでにタグ付けしているかの確認
        $exist = $this->is_tagging($tagId);

        if ($exist) {
            // すでにタグ付けしていれば何もしない
            return false;
        } else {
            // まだならタグ付けする
            $this->tags()->attach($tagId);
            return true;
        }
    }

    /**
     * $tagIdで指定されたタグ付けを外す。
     *
     * @param  int  $tagId
     * @return bool
     */
    public function remove_tag($tagId)
    {
        // すでにタグ付けしているかの確認
        $exist = $this->is_tagging($tagId);

        if ($exist) {
            // すでにタグ付けしていれば外す
            $this->tags()->detach($tagId);
            return true;
        } else {
            // まだであれば何もしない
            return false;
        }
    }

    /**
     * 指定された $tagIdのタグをこのレビューがタグ付け中であるか調べる。
     *
     * @param  int  $tagId
     * @return bool
     */
    public function is_tagging($tagId)
    {
        // タグ付け中のタグの中に $tagIdのものが存在するか
        return $this->tags()->where('tag_id', $tagId)->exists();
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
                    $query->whereHas('tags', function($query) use ($keyword) {
                            $query->where('content', 'like', '%' . $keyword . '%');
                        })
                        ->orWhere('menu', 'like', '%' . $keyword . '%')
                        ->orWhere('content', 'like', '%' . $keyword . '%');
                });
            }
        }
        
        return $query;
    }
    
}
