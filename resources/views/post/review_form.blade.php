@extends('layouts.app')

@section('content')
    <div class="text-center">
        <p>お店のレビューを入力してください</p>
    </div>
    
    <div class="row mb-4">
        <div class="col-sm-10 offset-sm-1">
            
            {!! Form::open(['' => '']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'メニュー名') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('satisfaction', '満足度') !!}
                    {!! Form::text('satisfaction', old('satisfaction'), ['class' => 'kv-uni-star rating-loading', 'data-size' => 'xl']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('email', 'タグ') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('password', '写真') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('textareaRemarks', 'コメント') !!}
                    {!! Form::textarea('textareaRemarks', null, ['class' => 'form-control', 'id' => 'textareaRemarks', 'placeholder' => 'レビューを記入してください', 'rows' => '3']) !!}
                </div>
                
                {!! Form::submit('投稿する', ['class' => 'btn btn-warning btn-block']) !!}
            {!! Form::close() !!}
            
            
        </div>
    </div>
@endsection