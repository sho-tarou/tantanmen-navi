<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;  //追記
use Intervention\Image\Facades\Image;  //追記
use Illuminate\Http\File; //追記
use Carbon\Carbon; //追記
use Illuminate\Validation\Rule; //追記
use Illuminate\Support\Facades\Session; //追記
use App\User; // 追加

class UsersController extends Controller
{
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザのレビュー一覧を取得
        $reviews = $user->reviews()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'reviews' => $reviews,
        ]);
    }
    
    public function edit($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // ユーザ編集ビューでそれを表示
        return view('users.edit', [
            'user' => $user,
        ]);
    }
    
    public function update($id, Request $request)
    {
        $user = User::find($id);
        
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id),], // 現在のアドレスは除いて一意であること
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // アップロードされたファイルであること、画像ファイルであること、MIMEタイプを指定、容量が1MBを超えないこと
            'image' => ['file', 'image', 'mimes:jpeg,png', 'max:1024']
        ]);
        
        if ($request->file('image')) {
            // 一時ファイル（$tmpFile）を生成し、そのパス（$tmpPath）を取得
            $now = date_format(Carbon::now(), 'YmdHis');
            $name = $request->file('image')->getClientOriginalName();
            $tmpFile = $now . '_' . $name;
            $tmpPath = storage_path('app/tmp/') . $tmpFile;
            
            // 更新前の画像のS3パスを取得
            $previousPath = $user->image_url;
            
            // 画像中央を縦横1:1の比率で切り抜き、縦幅・横幅350pxへリサイズ
            $image = Image::make($request->file('image'))
                ->fit(350, 350, function($constraint){
                    $constraint->upsize(); // 元画像より大きくなるのを防止
                })->save($tmpPath);
            
            // s3のprofileファイルに追加し、ファイルパスを取得
            $path = Storage::disk('s3')->putFile('/profile', new File($tmpPath), 'public');
            
            // 一時ファイルを削除
            Storage::disk('local')->delete('tmp/' . $tmpFile);
            
            // 更新前の画像をS3から削除
            Storage::disk('s3')->delete($previousPath);
        }else{
            $path = null;
            
            // 更新前の画像のS3パスを取得
            $previousPath = $user->image_url;
            // 更新前の画像をS3から削除
            Storage::disk('s3')->delete($previousPath);
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->image_url = $path;
        $user->save();
        
        Session::flash('updated_user', 'ユーザー情報を更新しました。');
        return redirect()->route('users.show', ['user' => $user->id]);
    }
    
    public function destroy($id)
    {
        
        $user = User::find($id);
        // 更新前の画像のS3パスを取得
        $previousPath = $user->image_url;
        // 更新前の画像をS3から削除
        Storage::disk('s3')->delete($previousPath);
        $user->delete();
 
        Session::flash('deleted_user', 'ユーザーの登録が削除されました。ご利用ありがとうございました。');
        return redirect('/');
    }
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    public function favorites($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのお気に入り一覧を取得
        $favorites = $user->favorites()->paginate(10);

        // お気に入り一覧ビューでそれらを表示
        return view('users.favorites', [
            'user' => $user,
            'reviews' => $favorites,
        ]);
    }
}
