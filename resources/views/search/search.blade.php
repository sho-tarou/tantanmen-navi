@extends('layouts.app')

@section('content')
    <!--↓↓ 検索フォーム ↓↓-->
    <div class="text-center mt-5 mb-3">
        <h3>レビュー検索</h3>
    </div>
    
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
            
            <div class="col-12 row mt-3">
                {!! Form::label('satisfaction', '満足度：', ['class' => 'col-12 col-sm-4 col-md-2 mt-2']) !!}
                <span class="ml-3">
                    {!! Form::text('satisfaction', $satisfaction, ['class' => 'kv-uni-star rating-loading col-12 col-sm-8 col-md-10', 'data-size' => 'sm']) !!}
                </span>
                <span class="mt-2">以上</span>
            </div>
            
            <div class="col-12 row mt-3">
                <p class="pl-3 col-12 col-sm-4 col-md-2">タグ（複数可）</p>
                <div class=" col-12 col-sm-8 col-md-10">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: grid; gap: 2px; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));">
                        @foreach($all_tags as $all_tag)
                            <label class="btn btn-outline-danger btn-sm {{ in_array($all_tag->id, $tagIds) ? "active" : '' }}">
                                <input type="checkbox" name="tags[]" value="{{ $all_tag->id }}" {{ in_array($all_tag->id, $tagIds) ? "checked" : '' }} autocomplete="off">
                                {{ $all_tag->content }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="offset-4 col-4 offset-md-5 col-md-2 mt-3">
                <input type="submit" value="検索" class="btn btn-info btn-block">
            </div>
        </div>
    </form>
    <!--↑↑ 検索フォーム ↑↑-->
    
    <p>検索結果</p>
    @if(count($reviews) > 0)
        <div>
            {{-- 投稿一覧 --}}
            @include('reviews.reviews')
        </div>
    @else
        <p>条件に合うレビューは見つかりませんでした。</p>
        <p>条件を変えてもう一度検索してください。</p>
    @endif
        
@endsection