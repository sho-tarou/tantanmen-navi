@extends('layouts.app')

@section('content')
    
    {{-- ユーザ情報 --}}
    @include('users.show_main')
    {{-- タブ --}}
    @include('users.navtabs')
    
@endsection