<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;  //追記
use Intervention\Image\Facades\Image;  //追記
use Illuminate\Http\File; //追記
use Carbon\Carbon; //追記
use Illuminate\Http\Request;  //追記
use Illuminate\Auth\Events\Registered;  //追記


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // アップロードされたファイルであること、画像ファイルであること、MIMEタイプを指定、容量が1MBを超えないこと
            'image' => ['file', 'image', 'mimes:jpeg,png', 'max:1024']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $path = null;
        
        if (isset($data['image'])) {
            // パスを生成
            $now = date_format(Carbon::now(), 'YmdHis');
            $name = $data['image']->getClientOriginalName();
            $path = 'profile/' . $now . '_' . $name;
            
            // 画像中央を縦横1:1の比率で切り抜き、縦幅・横幅350pxへリサイズ
            $image = Image::make($data['image'])
                ->fit(350, 350, function($constraint){
                    $constraint->upsize(); // 元画像より大きくなるのを防止
            })->stream();
            
            // s3のprofileファイルに追加
            Storage::disk('s3')->put($path, $image->__toString(), 'public');
        }
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image_url' => $path,
        ]);
    }
    
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
    
        event(new Registered($user = $this->create($request->all())));
    
        $this->guard()->login($user);
    
        session()->flash('register_user', 'ユーザー登録が完了しました');
    
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
