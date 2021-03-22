@extends('layouts.app')

@section('content')
    <div class="card" style="">
        <img class="card-img" src="{{ asset('/assets/images/tantanmen_sample.jpeg') }}" alt="">
        <div class="card-img-overlay">
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6 text-center text-light">
                    <p>あなたイチ押しの担々麺を投稿しよう！</p>
                    {{-- ログインページへのリンク --}}
                    <button class="btn btn-success btn-inline-block">ログイン</button>
                    <span>または</span>
                    {{-- ユーザ登録ページへのリンク --}}
                    {!! link_to_route('signup.get', 'ユーザー登録', [], ['class' => 'btn btn-success btn-inline-block']) !!}
                </div>
            </div>
        </div>
    </div>
    
    
    <!--↓↓ 検索フォーム ↓↓-->
    <p>レビューを検索</p>
    <div style="padding:10px 0px;">
        <form class="form" action="">
            <div class="form-group">
                <input type="text" name="keyword" value="" class="form-control" placeholder="キーワード">
            </div>
            <input type="submit" value="検索する" class="btn btn-info">
        </form>
    </div>
    <!--↑↑ 検索フォーム ↑↑-->
    
    <div>
        <p>新着レビュー</p>
        <div style="padding: 100px; margin: 0px; border: 1px solid #333333;">
            ここにレビューを表示
        </div>
    </div>
    
@endsection