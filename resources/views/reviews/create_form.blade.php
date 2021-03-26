@extends('layouts.app')

@section('content')
    <div class="text-center">
        <p>お店のレビューを入力してください</p>
    </div>
    
    <div class="row mb-4">
        <div class="col-sm-10 offset-sm-1">
            
            {!! Form::open(['route' => 'reviews.store', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('menu', 'メニュー名') !!}
                    {!! Form::text('menu', old('menu'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('satisfaction', '満足度') !!}
                    {!! Form::text('satisfaction', old('satisfaction'), ['class' => 'kv-uni-star rating-loading', 'data-size' => 'xl']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('tag', 'タグ') !!}
                    {!! Form::text('tag', old('tag'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('image', '画像ファイル') !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', 'コメント') !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'placeholder' => 'レビューを記入してください', 'rows' => '5']) !!}
                </div>
                
                {!! Form::submit('投稿する', ['class' => 'btn btn-warning btn-block']) !!}
            {!! Form::close() !!}
            
        </div>
    </div>
@endsection