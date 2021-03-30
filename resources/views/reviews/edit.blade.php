@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>レビューの編集</h1>
    </div>
    
    <div class="row mb-4">
        <div class="col-sm-10 offset-sm-1">
            
            {!! Form::open(['route' => ['reviews.update', $review->id], 'method' => 'PUT', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('menu', 'メニュー名') !!}
                    {!! Form::text('menu', $review->menu, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('satisfaction', '満足度') !!}
                    {!! Form::text('satisfaction', $review->satisfaction, ['class' => 'kv-uni-star rating-loading', 'data-size' => 'xl']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('tag', 'タグ') !!}
                    {!! Form::text('tag', $review->tag, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('image', '画像ファイル') !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', 'コメント') !!}
                    {!! Form::textarea('content', $review->content, ['class' => 'form-control', 'placeholder' => 'レビューを記入してください', 'rows' => '5']) !!}
                </div>
                
                {!! Form::submit('この内容で更新する', ['class' => 'btn btn-warning btn-block']) !!}
            {!! Form::close() !!}
            
        </div>
        <div class="col-sm-2 offset-sm-10">
            {!! Form::open(['route' => ['reviews.destroy', $review->id], 'method' => 'DELETE']) !!}
                {!! Form::submit('レビューを削除する', ['class'=>'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection