@extends('layouts.app')

@section('content')
    <p>（ユーザー名）さん</p>
    
    <div class="row  mb-3">
        <div class="col-sm-5">
            <div style="padding: 100px; margin: 0px; border: 1px solid #333333;">
                写真
                <img class="mr-2 rounded" src="" alt="">
            </div>
            <button class="btn btn-primary btn-block">フォローする</button>
        </div>
        
        <div class="col-sm-7">
            <button class="btn btn-warning btn-block">新しいレビューを投稿する</button>
        </div>
    </div>
    
    @include('users.navtabs')
    
@endsection