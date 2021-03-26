@extends('layouts.app')

@section('content')
    <div>
        <li>{{ $review->user->name }}さん</li>
        <li>（店名）</li>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <div style="padding: 100px; margin: 0px; border: 1px solid #333333;">
                写真
                <img class="mr-2 rounded" src="" alt="">
            </div>
            <button class="btn btn-danger btn-block">お気に入りする</button>
        </div>
        <div class="col-sm-7">
            <li>メニュー名</li>
            <li>満足度</li>
            <li>タグ</li>
            <li>レビュー</li>
        </div>
    </div>
    
@endsection