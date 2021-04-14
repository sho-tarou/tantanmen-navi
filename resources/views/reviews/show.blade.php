@extends('layouts.app')

@section('content')
    <div class="text-center m-5">
        <h3>レビュー詳細</h3>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <div>
                {{-- 投稿者のユーザ詳細ページへのリンク --}}
                {!! link_to_route('users.show', $review->user->name, ['user' => $review->user->id]) !!}
            </div>
            <div>
                {{-- この投稿の店舗詳細ページへのリンク --}}
                {!! link_to_route('shops.show', $review->shop->name, ['shop' => $review->shop->id]) !!}
            </div>
        </div>
        <div class="col-sm-7 text-right">
            @if (Auth::check())
                @if (Auth::id() == $review->user->id)
                    {{-- 投稿編集ページへのリンク --}}
                    {!! link_to_route('reviews.edit', 'この投稿を編集する', ['review' => $review->id], ['class' => 'text-muted']) !!}
                @endif
            @endif
        </div>
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
            {{-- お気に入りボタン --}}
            <div class="mt-1">
                @include('favorite.favorite_button')
            </div>
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
                    <td>
                        @if (count($tags) > 0)
                            @foreach ($tags as $tag)
                                <span class="badge badge-danger">{{ $tag->content }}</span>
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>コメント</th>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" class="border"  style="white-space:pre-wrap;">{{ $review->content }}</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    
@endsection