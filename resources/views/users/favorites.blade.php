@extends('layouts.app')

@section('content')
    
    {{-- ユーザ情報 --}}
    @include('users.show_main')
    {{-- タブ --}}
    @include('users.navtabs')
        {{-- レビュー一覧 --}}
        @include('reviews.reviews')
    
@endsection