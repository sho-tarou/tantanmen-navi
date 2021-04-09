<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'yahoo_api_id','name','yomi','address','prefecture','station1','railway1','walking_time1','station2','railway2','walking_time2','station3','railway3','walking_time3','parking','tel','pc_url',
    ];

    /**
     * この店舗に関するレビュー。（ Reviewモデルとの関係を定義）
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    /**
     * この店舗に関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('reviews');
    }
    
    /**
     * 絞り込み・キーワード検索
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array
     * @return \Illuminate\Database\Eloquent\Builder
     */
     public function scopeSearch($query, $request, $prefecture)
    {
        $shop_name = $request->input('shop_name');
        
        // 都道府県絞り込み
        if ($prefecture != '全国') {
            $query->where('prefecture', $prefecture);
        }
        
        // キーワードで絞り込み
        if(!empty($shop_name)) {
            $query->where(function ($query) use ($shop_name) {
                $query->where('name', 'like', '%' . $shop_name . '%')
                    ->orWhere('yomi', 'like', '%' . $shop_name . '%');
            });
        }
        
        return $query;
    }
}