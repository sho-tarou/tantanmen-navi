@extends('layouts.app')

@section('content')

    <div class="text-center">
        <h1>{{ $user->name }}の登録情報の変更</h1>
    </div>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            
            {!! Form::open(['route' => ['users.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'お名前') !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワード（確認用）') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('image', '画像ファイル') !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('この内容で更新する', ['class' => 'btn btn-success btn-block']) !!}
            {!! Form::close() !!}
            
        </div>
        <div class="col-sm-2 offset-sm-10">
            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                {!! Form::submit('登録を削除する', ['class'=>'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection