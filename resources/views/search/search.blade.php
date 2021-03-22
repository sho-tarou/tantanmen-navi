@extends('layouts.app')

@section('content')
    <!--↓↓ 検索フォーム ↓↓-->
    <p>レビューを検索</p>
    <div class="col-sm-4" style="padding:20px 0; padding-left:0px;">
        <form class="form-inline" action="">
            <div class="form-group">
                <input type="text" name="keyword" value="" class="form-control" placeholder="キーワード">
            </div>
            <input type="submit" value="検索" class="btn btn-info">
        </form>
    </div>
    <!--↑↑ 検索フォーム ↑↑-->
    
@endsection