@extends('layouts.app')

@section('content')
    <div class="text-center m-5">
        <h3>ユーザー登録</h3>
    </div>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            
            {!! Form::open(['route' => 'signup.post', 'files' => true]) !!}
                @csrf
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('name', 'お名前') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'required']) !!}
                </div>
                
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'required']) !!}
                </div>
                
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                </div>
                
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('password_confirmation', 'パスワード（確認用）') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('image', 'プロフィール写真（1MBまで）') !!}
                    {!! Form::file('image', ['class' => 'form-control-file', 'onchange' => 'previewImage(this)']) !!}
                </div>
                <p>
                画像プレビュー：<br>
                <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:200px;">
                </p>
                
                {!! Form::submit('登録する', ['class' => 'btn btn-success mx-auto d-block']) !!}
            {!! Form::close() !!}
            
            <div class="text-right">
                {!! link_to_route('login', 'ログインはこちらへ') !!}
            </div>
        </div>
    </div>
@endsection