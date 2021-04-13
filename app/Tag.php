<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * このタグと同じタグが付いているレビュー。（ Reviewモデルとの関係を定義）
     */
    public function same_tag_reviews()
    {
        return $this->belongsToMany(Review::class, 'review_tag', 'tag_id', 'review_id')->withTimestamps();
    }
}
