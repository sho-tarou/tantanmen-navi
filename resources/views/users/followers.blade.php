@extends('layouts.app')

@section('content')
    
    {{-- ユーザ情報 --}}
    @include('users.show_main')
    {{-- タブ --}}
    @include('users.navtabs')
        {{-- ユーザ一覧 --}}
        @include('users.users')
    
@endsection