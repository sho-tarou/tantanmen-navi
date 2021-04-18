@extends('layouts.app')

@section('content')
    <div class="text-center m-5">
        <h3>{{ $user->name }}さんの登録情報の変更</h3>
    </div>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            
            {!! Form::open(['route' => ['users.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
                @csrf
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('name', 'お名前') !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control', 'required']) !!}
                </div>
                
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', $user->email, ['class' => 'form-control', 'required']) !!}
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
                <img id="preview" src="https://tantanmen-navi.s3-ap-northeast-1.amazonaws.com/{{ $user->image_url }}" style="max-width:200px;">
                </p>
                
                {!! Form::submit('この内容で更新する', ['class' => 'btn btn-success mx-auto d-block']) !!}
            {!! Form::close() !!}
            
        </div>
        <div class="col-sm-2 offset-sm-10">
            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                {!! Form::submit('登録を削除する', ['class'=>'btn btn-danger btn-sm m-3']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection