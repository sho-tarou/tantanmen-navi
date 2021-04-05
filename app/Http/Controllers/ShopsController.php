<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;

class ShopsController extends Controller
{
    public function show($id)
    {
        // idの値で店舗を検索して取得
        $shop = Shop::findOrFail($id);
        
        // この店舗のレビュー一覧を取得
        $reviews = $shop->reviews()->orderBy('created_at', 'desc')->paginate(10);
        
        // showビューでそれを表示
        return view('shops.show', [
            'shop' => $shop,
            'reviews' => $reviews
        ]);
    }
}
