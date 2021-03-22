@extends('layouts.app')

@section('content')
    <!--↓↓ 検索フォーム ↓↓-->
    <p>レビューを投稿するお店を検索してください</p>
    <div style="padding:10px 0px;">
        <form class="form" action="">
            <div class="form-group">
                <input type="text" name="keyword" value="" class="form-control" placeholder="キーワード">
            </div>
            <input type="submit" value="検索する" class="btn btn-info text-center">
        </form>
    </div>
    <!--↑↑ 検索フォーム ↑↑-->
    
    <p>検索結果</p>
    <div>
        <table class="mt-4 table table-bordered table-striped">
            <tbody>
                <tr>
                    <td width="20%">大阪府</td>
                    <td width="50%">～～～店</td>
                    <td width="30%"><button class="btn btn-warning">レビュー入力画面へ</button></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection