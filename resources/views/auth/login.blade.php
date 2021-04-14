@extends('layouts.app')

@section('content')
    <div class="text-center m-5">
        <h3>ログイン</h3>
    </div>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            
            {!! Form::open(['route' => 'login.post']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('ログイン', ['class' => 'btn btn-success mx-auto d-block']) !!}
            {!! Form::close() !!}
            
            <div class="text-right">
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'ユーザー登録はこちらへ') !!}
            </div>
        </div>
    </div>
@endsection