@extends('layouts.app')

@section('content')
    <!--↓↓ 検索フォーム ↓↓-->
    <h2>レビューを検索</h2>
    
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
            <div class="offset-4 col-4 offset-md-5 col-md-2 mt-1">
                <input type="submit" value="検索" class="btn btn-info btn-block">
            </div>
        </div>
    </form>
    <!--↑↑ 検索フォーム ↑↑-->
    
    <p>検索結果</p>
        <div style="margin: 0px; border: 1px solid #333333;">
            {{-- 投稿一覧 --}}
            @include('reviews.reviews')
        </div>
    
@endsection