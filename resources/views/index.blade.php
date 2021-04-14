@extends('layouts.app')

@section('content')
    <div class="card" style="">
        <img class="card-img" src="{{ asset('/assets/images/tantanmen_sample.jpeg') }}" alt="">
        <div class="card-img-overlay" style="padding: 0;  top: calc(50% - 3.5rem);  font-weight: bold;">
            <div class="row">
                <div class="col-12 text-center p-2" style="background-color: rgba( 255, 255, 255, 0.55 );">
                    <p>イチ押しの担々麺を投稿しよう！</p>
                    @if (Auth::check())
                        {{-- 投稿ページへのリンク --}}
                        {!! link_to_route('reviews.create', 'レビューを投稿する', [], ['class' => 'btn btn-warning btn-inline-block']) !!}
                    @else
                        {{-- ユーザ登録ページへのリンク --}}
                        {!! link_to_route('signup.get', 'ユーザー登録', [], ['class' => 'btn btn-success btn-inline-block']) !!}
                        <span>または</span>
                        {{-- ログインページへのリンク --}}
                        {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-success btn-inline-block']) !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    
    <!--↓↓ 検索フォーム ↓↓-->
    <form class="" method="get" action="{{ route('search.search') }}">
        <div class="row" style="padding:20px 0;">
            <div class="col-4 col-md-2">
                {!! Form::select('shop_pref', $pref_index, $shop_pref, ['class' => 'form-control']) !!}
            </div>
            <div class="col-8 col-md-3">
                <input type="text" name="shop_name" value="{{ $shop_name }}" class="form-control" placeholder="店名">
            </div>
            <div class="col-12 col-md-7">
                <input type="text" name="keyword" value="{{ $keyword }}" class="form-control" placeholder="キーワード（複数入力するときは間にスペースを入れてください）">
            </div>
            <div class="offset-sm-4 col-sm-4 offset-md-5 col-md-2 mt-3">
                <input type="submit" value="レビューを検索" class="btn btn-info btn-block">
            </div>
        </div>
    </form>
    <!--↑↑ 検索フォーム ↑↑-->
    
    <div>
        <p>新着レビュー</p>
        <div>
            {{-- 投稿一覧 --}}
            @include('reviews.reviews')
        </div>
    </div>
    
@endsection