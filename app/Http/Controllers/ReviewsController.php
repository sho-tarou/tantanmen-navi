<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review; // 追加
use Illuminate\Support\Facades\Storage;  //追記
use Intervention\Image\Facades\Image;  //追記
use Illuminate\Http\File; //追記
use Carbon\Carbon; //追記

class ReviewsController extends Controller
{
    public function index()
    {
        $data = [];
        // 全投稿の一覧を作成日時の降順で取得
        $reviews = Review::orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'reviews' => $reviews,
        ];
        
        // indexビューでそれらを表示
        return view('index', $data);
    }
    
    public function create()
    {
        // createビューを表示
        return view('reviews.create');
    }
    
    public function create_form()
    {
        // create_formビューを表示
        return view('reviews.create_form');
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'menu' => 'required|string|max:255',
            'satisfaction' => 'required|numeric',
            'image' => 'required|file|image|mimes:jpeg,png|max:1024',
            'content' => 'required|string|max:3000',
        ]);

        if ($request->image) {
            // 一時ファイル（$tmpFile）を生成し、そのパス（$tmpPath）を取得
            $now = date_format(Carbon::now(), 'YmdHis');
            $name = $request->image->getClientOriginalName();
            $tmpFile = $now . '_' . $name;
            $tmpPath = storage_path('app/tmp/') . $tmpFile;
            
            // 画像中央を縦横1:1の比率で切り抜き、縦幅・横幅350pxへリサイズ
            $image = Image::make($request->image)
                ->fit(350, 350, function($constraint){
                    $constraint->upsize(); // 元画像より大きくなるのを防止
                })->save($tmpPath);
            
            // s3のtantanmenファイルに追加し、ファイルパスを取得
            $path = Storage::disk('s3')->putFile('/tantanmen', new File($tmpPath), 'public');
            
            // 一時ファイルを削除
            Storage::disk('local')->delete('tmp/' . $tmpFile);
        }
        
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->reviews()->create([
            'menu' => $request->menu,
            'satisfaction' => $request->satisfaction,
            'content' => $request->content,
            'image_url' => $path,
        ]);

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}