@extends('layouts.app')

@section('content')
    <div>
        <p>
            {{-- 投稿者のユーザ詳細ページへのリンク --}}
            {!! link_to_route('users.show', $review->user->name, ['user' => $review->user->id]) !!}
        </p>
        <p>（店名）</p>
    </div>
    <div class="row">
        <div class="col-sm-5">
            {{-- 投稿写真を表示 --}}
            @if ($review->image_url == null)
                {{-- デフォルト写真を表示 --}}
                <img class="img-thumbnail img-fluid mx-auto d-block" src="{{ asset('/assets/images/profile_default_350px.png') }}" alt="tantanmen image">
            @else
                {{-- 担々麺の写真を表示 --}}
                <img class="img-thumbnail img-fluid mx-auto d-block" src="https://tantanmen-navi.s3-ap-northeast-1.amazonaws.com/{{ $review->image_url }}" alt="tantanmen image">
            @endif
            
            <button class="btn btn-danger btn-block">お気に入りする</button>
        </div>
        <div class="col-sm-7">
            <table class="table table-borderless">
            <tbody>
                <tr>
                    <th width="40%">メニュー</th>
                    <td width="60%">{{ $review->menu }}</td>
                </tr>
                <tr>
                    <th>満足度</th>
                    <td>
                        <input id="satisfaction" name="satisfaction" value="{{ $review->satisfaction }}" class="kv-uni-star rating-loading" data-readonly="true" data-show-clear="false">
                    </td>
                </tr>
                <tr>
                    <th>タグ</th>
                    <td>tag</td>
                </tr>
                <tr>
                    <th>コメント</th>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" class="border">{{ $review->content }}</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    
@endsection