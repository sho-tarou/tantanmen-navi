@extends('layouts.app')

@section('content')
    <div class="text-center m-5">
        <h3>レビューの編集</h3>
    </div>
    
    <div class="row mb-4">
        <div class="col-sm-10 offset-sm-1">
            
            {!! Form::open(['route' => ['reviews.update', $review->id], 'method' => 'PUT', 'files' => true]) !!}
                @csrf
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('menu', 'メニュー名') !!}
                    {!! Form::text('menu', $review->menu, ['class' => 'form-control', 'required']) !!}
                </div>
                
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('satisfaction', '満足度') !!}
                    {!! Form::text('satisfaction', $review->satisfaction, ['class' => 'kv-uni-star rating-loading', 'data-size' => 'xl']) !!}
                </div>
                
                <p>タグ（複数可）</p>
                <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: grid; gap: 2px; grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));">
                    @foreach($all_tags as $all_tag)
                        <label class="btn btn-outline-danger {{ in_array($all_tag->id, $tagIds) ? "active" : '' }}">
                            <input type="checkbox" name="tags[]" value="{{ $all_tag->id }}" {{ in_array($all_tag->id, $tagIds) ? "checked" : '' }} autocomplete="off">
                            {{ $all_tag->content }}
                        </label>
                    @endforeach
                </div>
                
                <div class="form-group mt-4">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('image', '写真（1MBまで）') !!}
                    {!! Form::file('image', ['class' => 'form-control-file', 'required']) !!}
                </div>
                
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('content', 'コメント') !!}
                    {!! Form::textarea('content', $review->content, ['class' => 'form-control', 'placeholder' => 'レビューを記入してください', 'rows' => '5', 'required']) !!}
                </div>
                
                {!! Form::submit('この内容で更新する', ['class' => 'btn btn-warning mx-auto d-block']) !!}
            {!! Form::close() !!}
            
        </div>
        <div class="col-sm-2 offset-sm-10">
            {!! Form::open(['route' => ['reviews.destroy', $review->id], 'method' => 'DELETE']) !!}
                {!! Form::submit('レビューを削除する', ['class'=>'btn btn-danger btn-sm m-3']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection