<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// トップページ
Route::get('/', 'ReviewsController@index'); // 上書き

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// 認証済みユーザーのみ
Route::group(['middleware' => ['auth']], function () {
    // ユーザー情報の編集、削除
    Route::resource('users', 'UsersController', ['only' => ['edit', 'update', 'destroy']]);
    // ユーザーのフォロー、アンフォロー
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
    });
    // レビューの投稿、編集、削除
    Route::resource('reviews', 'ReviewsController', ['only' => [ 'store', 'edit', 'update', 'destroy']]);
    Route::get('reviews.create', 'ReviewsController@create')->name('reviews.create');
    Route::post('reviews.create_form', 'ReviewsController@create_form')->name('reviews.create_form');
    // レビューのstoreアクションでバリデーションエラーとなった場合
    Route::get('reviews.create_form', 'ReviewsController@create_form_error');
    
    // レビューのお気に入り追加、削除
    Route::group(['prefix' => 'reviews/{id}'], function () {
        Route::post('favorite', 'FavoriteController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoriteController@destroy')->name('favorites.unfavorite');
    });
});

// ユーザーの詳細表示（誰でも）
Route::resource('users', 'UsersController', ['only' => ['show']]);

// ユーザーのフォロー、フォロワー、お気に入りの一覧表示（誰でも）
Route::group(['prefix' => 'users/{id}'], function () {
    Route::get('followings', 'UsersController@followings')->name('users.followings');
    Route::get('followers', 'UsersController@followers')->name('users.followers');
    Route::get('favorites', 'UsersController@favorites')->name('users.favorites');
});

// レビューの一覧、詳細表示（誰でも）
Route::resource('reviews', 'ReviewsController', ['only' => ['index', 'show']]);
// レビュー投稿前の店舗情報取得
Route::post('reviews.create', 'ReviewsController@yahoo_api_search')->name('yahoo_api_search');

// 店舗詳細画面
Route::resource('shops', 'ShopsController', ['only' => ['show']]);

// レビュー検索画面
Route::get('search.serach', 'ReviewsController@search')->middleware('keyword')->name('search.search');
