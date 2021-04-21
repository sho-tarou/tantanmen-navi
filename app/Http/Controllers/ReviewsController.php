<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review; // 追加
use App\Shop; // 追加
use App\Tag; // 追加
use Illuminate\Support\Facades\Storage;  //追記
use Intervention\Image\Facades\Image;  //追記
use Illuminate\Http\File; //追記
use Carbon\Carbon; //追記
use Illuminate\Support\Facades\Session; //追記

class ReviewsController extends Controller
{
    public function index()
    {
        $data = [];
        // 全投稿の一覧を作成日時の降順で取得
        $reviews = Review::orderBy('created_at', 'desc')->paginate(10);
        foreach($reviews as $review){
            $review->tags = $review->tags()->get();
        }
        
        $pref_index = config('pref_index');
        $keyword = null;
        $shop_pref = null;
        $shop_name = null;
        
        $data = [
            'reviews' => $reviews,
            'pref_index' => $pref_index,
            'keyword' => $keyword,
            'shop_pref' => $shop_pref,
            'shop_name' => $shop_name,
        ];
        
        // indexビューでそれらを表示
        return view('index', $data);
    }
    
    public function show($id)
    {
        // idの値でレビューを検索して取得
        $review = Review::findOrFail($id);
        
        // タグを取得
        $tags = $review->tags()->get();
        
        // showビューでそれを表示
        return view('reviews.show', [
            'review' => $review,
            'tags' => $tags,
        ]);
    }
    
    public function create()
    {
        $shops = array();
        $key_pref = null;
        $keyword = null;
        $pref_index = config('pref_index');
        
        // createビューを表示
        return view('reviews.create')->with([
            'shops' => $shops,
            'key_pref' => $key_pref,
            'keyword' => $keyword,
            'pref_index' => $pref_index,
        ]);
    }
    
    public function yahoo_api_search(Request $request)
    {
        $shops = array();
        $key_pref =null;
        $keyword =null;
        $pref_index = config('pref_index');
        
        if($request->key_pref || $request->keyword) {
            // 検索条件
            $params = array(
                'appid' => config('services.yahoo_api.key'),
                'output' => 'json',
                'results' => '20', // 取得件数
                'sort' => 'match',
                'gc' => '0104,0106', // 業種コード
                'ac' => $request->key_pref, // 都道府県コード
                'query' => $request->keyword, // 検索ワード
            );
            
            // 検索条件からurlを生成し、jsonファイルを受け取る
            $url = 'https://map.yahooapis.jp/search/local/V1/localSearch?' . http_build_query($params);
            $json = file_get_contents($url);
            // 受け取ったjsonファイルをUTF8にエンコードし配列にする
            $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
            $response = json_decode($json, true);
            
            if (empty($response)) {
                return; // データがない時の処理
            }else{
                // 存在しているときの処理
                
                $data_length = $response['ResultInfo']['Count'];
                for ($i=0; $i<$data_length; $i++){
                    $shops[$i] = [
                        // isset()と三項演算子を使用して、各項目が未定義だった場合は''を取得させる
                        'name' => isset($response['Feature'][$i]['Name']) ? $response['Feature'][$i]['Name'] : '',
                        'yahoo_api_id' => isset($response['Feature'][$i]['Property']['Uid']) ? $response['Feature'][$i]['Property']['Uid'] : '',
                        'yomi' => isset($response['Feature'][$i]['Property']['Yomi']) ? $response['Feature'][$i]['Property']['Yomi'] : '',
                        'address' => isset($response['Feature'][$i]['Property']['Address']) ? $response['Feature'][$i]['Property']['Address'] : '',
                        'address_code' => isset($response['Feature'][$i]['Property']['GovernmentCode']) ? $response['Feature'][$i]['Property']['GovernmentCode'] : '',
                        'station1' => isset($response['Feature'][$i]['Property']['Station']['Name'][0]) ? $response['Feature'][$i]['Property']['Station']['Name'][0] : '',
                        'railway1' => isset($response['Feature'][$i]['Property']['Station']['Railway'][0]) ? $response['Feature'][$i]['Property']['Station']['Railway'][0] : '',
                        'walking_time1' => isset($response['Feature'][$i]['Property']['Station']['Time'][0]) ? $response['Feature'][$i]['Property']['Station']['Time'][0] : '',
                        'station2' => isset($response['Feature'][$i]['Property']['Station']['Name'][1]) ? $response['Feature'][$i]['Property']['Station']['Name'][1] : '',
                        'railway2' => isset($response['Feature'][$i]['Property']['Station']['Railway'][1]) ? $response['Feature'][$i]['Property']['Station']['Railway'][1] : '',
                        'walking_time2' => isset($response['Feature'][$i]['Property']['Station']['Time'][1]) ? $response['Feature'][$i]['Property']['Station']['Time'][1] : '',
                        'station3' => isset($response['Feature'][$i]['Property']['Station']['Name'][2]) ? $response['Feature'][$i]['Property']['Station']['Name'][2] : '',
                        'railway3' => isset($response['Feature'][$i]['Property']['Station']['Railway'][2]) ? $response['Feature'][$i]['Property']['Station']['Railway'][2] : '',
                        'walking_time3' => isset($response['Feature'][$i]['Property']['Station']['Time'][2]) ? $response['Feature'][$i]['Property']['Station']['Time'][2] : '',
                        'parking' => isset($response['Feature'][$i]['Property']['ParkingFlag']) ? $response['Feature'][$i]['Property']['ParkingFlag'] : '',
                        'tel' => isset($response['Feature'][$i]['Property']['Tel1']) ? $response['Feature'][$i]['Property']['Tel1'] : '',
                        'pc_url' => isset($response['Feature'][$i]['Property']['Detail']['PcUrl1']) ? $response['Feature'][$i]['Property']['Detail']['PcUrl1'] : '',
                    ];
                    // address_codeの頭2桁をキーとして、$pref_index配列から都道府県を取得して表示
                    $shops[$i]['prefecture'] = isset($shops[$i]['address_code']) ? $pref_index[substr($shops[$i]['address_code'], 0, 2)] : '';
                }
            }
        }
        
        return view('reviews.create')->with([
            'shops' => $shops,
            'key_pref' => $request->key_pref,
            'keyword' => $request->keyword,
            'pref_index' => $pref_index,
        ]);
    }
    
    public function create_form(Request $request)
    {
        // バリデーション
        $request->validate([
            // 店舗情報
            'name' => 'required|string|max:255',
            'yahoo_api_id' => 'nullable|string|max:255',
            'yomi' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'prefecture' => 'required|string|max:255',
            'station1' => 'nullable|string|max:255',
            'railway1' => 'nullable|string|max:255',
            'walking_time1' => 'nullable|numeric',
            'station2' => 'nullable|string|max:255',
            'railway2' => 'nullable|string|max:255',
            'walking_time2' => 'nullable|numeric',
            'station3' => 'nullable|string|max:255',
            'railway3' => 'nullable|string|max:255',
            'walking_time3' => 'nullable|numeric',
            'parking' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'pc_url' => 'nullable|string|max:255',
        ]);
        
        $all_tags = Tag::all();
        
        // create_formビューを表示
        return view('reviews.create_form')->with([
            'shop' => $_POST,
            'all_tags' => $all_tags,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            // レビュー内容
            'menu' => 'required|string|max:255',
            'satisfaction' => 'nullable',
            'tags' => 'array',
            'image' => 'required|file|image|mimes:jpeg,png|max:1024',
            'content' => 'required|string|max:3000',
        ]);
        
        if ($request->image) {
            // パスを生成
            $now = date_format(Carbon::now(), 'YmdHis');
            $name = $request->image->getClientOriginalName();
            $path = 'tantanmen/' . $now . '_' . $name;
            
            // 画像中央を縦横1:1の比率で切り抜き、縦幅・横幅350pxへリサイズ
            $image = Image::make($request->image)
                ->fit(350, 350, function($constraint){
                    $constraint->upsize(); // 元画像より大きくなるのを防止
                })->stream();
            
            // s3のprofileファイルに追加
            Storage::disk('s3')->put($path, $image->__toString(), 'public');
        }
        
        $shop = Shop::updateOrCreate(['yahoo_api_id' => $request->yahoo_api_id],[
            'name' => $request->name,
            'yahoo_api_id' => $request->yahoo_api_id,
            'yomi' => $request->yomi,
            'address' => $request->address,
            'prefecture' => $request->prefecture,
            'station1' => $request->station1,
            'railway1' => $request->railway1,
            'walking_time1' => $request->walking_time1,
            'station2' => $request->station2,
            'railway2' => $request->railway2,
            'walking_time2' => $request->walking_time2,
            'station3' => $request->station3,
            'railway3' => $request->railway3,
            'walking_time3' => $request->walking_time3,
            'parking' => $request->parking,
            'tel' => $request->tel,
            'pc_url' => $request->pc_url, 
        ]);

        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $review = $request->user()->reviews()->create([
            'menu' => $request->menu,
            'satisfaction' => $request->satisfaction,
            'content' => $request->content,
            'image_url' => $path,
            'shop_id' => $shop->id,
        ]);
        
        if($request->tags) {
            $tagIds = array_map('intval', $request->tags);
            foreach($tagIds as $tagId) {
                $review->tag($tagId);
            }
        }

        // トップページへリダイレクトさせる
        Session::flash('created_review', 'レビューを投稿できました。');
        return redirect('/');
    }
    
    public function create_form_error(Request $request)
    {
        // storeアクションでバリデーションエラーとなった場合のアクション
        
        // 前画面でのhidden項目を含めた入力情報をセッションとして次々リクエストまで保持
        $request->session()->keep(['_old_input']);
        // セッションを読み込む
        $data = $request->session()->get('_old_input');
        
        // create_formビューを表示
        return view('reviews.create_form')->with([
            'shop' => $data,
        ]);
    }
    
    public function edit($id)
    {
        // idの値でレビューを検索して取得
        $review = Review::findOrFail($id);
        // このレビューについているタグのオブジェクトを取得
        $tags = $review->tags()->get();
        // 各オブジェクトからidを抜き出し、配列にする
        $tagIds[] = '';
        foreach($tags as $tag) {
            $tagIds[] = $tag->id;
        }
        
        $all_tags = Tag::all();
        
        // editビューを表示
        return view('reviews.edit', [
            'review' => $review,
            'tagIds' => $tagIds,
            'all_tags' => $all_tags,
        ]);
    }
    
    public function update($id, Request $request)
    {
        $review = Review::find($id);
        
        $this->validate($request, [
            'menu' => 'required|string|max:255',
            'satisfaction' => '',
            'tags' => 'array',
            'image' => 'file|image|mimes:jpeg,png|max:1024',
            'content' => 'required|string|max:3000',
        ]);
        
        if ($request->file('image')) {
            // パスを生成
            $now = date_format(Carbon::now(), 'YmdHis');
            $name = $request->file('image')->getClientOriginalName();
            $path = 'tantanmen/' . $now . '_' . $name;
            
            // 更新前の画像のS3パスを取得
            $previousPath = $review->image_url;
            
            // 画像中央を縦横1:1の比率で切り抜き、縦幅・横幅350pxへリサイズ
            $image = Image::make($request->file('image'))
                ->fit(350, 350, function($constraint){
                    $constraint->upsize(); // 元画像より大きくなるのを防止
                })->stream();
            
            // s3のtantanmenファイルに追加
            Storage::disk('s3')->put($path, $image->__toString(), 'public');
            
            // 更新前の画像をS3から削除
            Storage::disk('s3')->delete($previousPath);
            
            $review->image_url = $path;
        }
        
        $review->menu = $request->menu;
        $review->satisfaction = $request->satisfaction;
        $review->content = $request->content;
        
        $review->save();
        
        // 更新前のタグを取得しidを配列にする
        $previous_tags = $review->tags()->get();
        $previous_tagIds[] = '';
        foreach($previous_tags as $previous_tag) {
            $previous_tagIds[] = $previous_tag->id;
        }
        
        if($previous_tagIds) {
            $previous_int_tagIds = array_map('intval', $previous_tagIds);
            // 更新前のタグを削除
            foreach($previous_int_tagIds as $previous_int_tagId) {
                $review->remove_tag($previous_int_tagId);
            }
        }
        
        // 更新後のタグを取得し保存
        if($request->tags) {
            $tagIds = array_map('intval', $request->tags);
            foreach($tagIds as $tagId) {
                $review->tag($tagId);
            }
        }
        
        Session::flash('updated_review', 'レビューを更新しました。');
        return redirect()->route('reviews.show', ['review' => $review->id]);
    }
    
    public function destroy($id)
    {
        
        $review = Review::find($id);
        // 更新前の画像のS3パスを取得
        $previousPath = $review->image_url;
        // 更新前の画像をS3から削除
        Storage::disk('s3')->delete($previousPath);
        $review->delete();
 
        Session::flash('deleted_review', 'レビューが削除されました。');
        return redirect()->route('users.show', ['user' => $review->user->id]);
    }
    
    public function search(Request $request)
    {
        // 都道府県コードを日本語に変換
        $pref_index = config('pref_index');
        $prefecture = $pref_index[$request->shop_pref];
        
        // Shopモデルにて都道府県と店名で店舗を絞り込んでモデルを取得し、idカラムを配列で抜き出す
        $shop_ids = Shop::search($request, $prefecture)->pluck('id');
        
        // Reviewモデルにてキーワードと店舗idでレビューを絞り込んでモデルを取得
        $reviews = Review::search($request, $shop_ids)->orderBy('created_at', 'desc')->paginate(10);
        
        // keywordを配列からスペース区切りの文字列に戻す
        if($request->keyword) {
            $keyword = implode( "　", $request->keyword);
        }else{
            $keyword = $request->keyword;
        }
        
        if($request->tags) {
            $tagIds = array_map('intval', $request->tags);
        }else{
            $tagIds = [];
        }
        $all_tags = Tag::all();
        
        return view('search.search')->with([
            'reviews' => $reviews,
            'pref_index' => $pref_index,
            'keyword' => $keyword,
            'satisfaction' => $request->satisfaction,
            'shop_pref' => $request->shop_pref,
            'shop_name' => $request->shop_name,
            'all_tags' => $all_tags,
            'tagIds' => $tagIds,
        ]);
    }
}
