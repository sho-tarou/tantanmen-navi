@extends('layouts.app')

@section('content')
    <!--↓↓ 検索フォーム ↓↓-->
    <p>レビューを投稿するお店を検索してください</p>
    
    {!! Form::open(['route' => 'yahoo_api_search']) !!}
        <div class="row">
            <div class="col-sm-3">
                {!! Form::select('key_pref', $pref_index, $key_pref, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-9">
                {!! Form::text('keyword', $keyword, ['class' => 'form-control', 'placeholder' => 'キーワード（店名、地域など）']) !!}
            </div>
        </div>    
        <div class="d-flex justify-content-center m-3">
            {!! Form::submit('検索する', ['class' => 'btn btn-info btn-inline-block']) !!}
        </div>
    {!! Form::close() !!}
    <!--↑↑ 検索フォーム ↑↑-->
    
    @if($key_pref || $keyword)
        @if($shops)
            <div>
                <table class="mt-4 table table-bordered table-striped">
                    @foreach($shops as $shop)
                        <tbody>
                            <tr>
                                <td width="20%">
                                    {{ $shop['prefecture'] }}
                                </td>
                                <td width="50%">
                                    {{ $shop['name'] }}
                                </td>
                                <td width="30%">
                                    @if (Auth::check())
                                        {!! Form::open(['route' => 'reviews.create_form']) !!}
                                            @csrf
                                            {{-- 各shop中の渡したい項目の数だけhiddenインプット要素を生成 --}}
                                            @foreach($shop as $key => $value)
                                                {!! Form::hidden($key, $value) !!}
                                            @endforeach
                                            
                                            {{-- レビュー入力ページへのリンク --}}
                                            {!! Form::submit('このお店のレビューを入力する', ['class' => 'btn btn-warning btn-block']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        @else
            <p>検索結果</p>
            <p>条件に合う店舗は見つかりませんでした。</p>
            <p>条件を変えてもう一度検索してください。</p>
        @endif
    @endif
@endsection