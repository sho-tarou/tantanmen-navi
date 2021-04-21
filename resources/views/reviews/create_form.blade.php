@extends('layouts.app')

@section('content')
    <div class="text-center m-5">
        <h3>お店のレビューを入力してください</h3>
    </div>
    
    <div class="row mb-4">
        <div class="col-sm-10 offset-sm-1">
            
            {!! Form::open(['route' => 'reviews.store', 'files' => true, 'method' => 'post']) !!}
                @csrf
                <div class="form-group">
                    {{-- 各shop中の渡したい項目の数だけhiddenインプット要素を生成 --}}
                    @foreach($shop as $key => $value)
                        {!! Form::hidden($key, $value) !!}
                    @endforeach
                </div>
                
                <div class="form-group">
                    {!! Form::label('name', '店名') !!}
                    {!! Form::text('name', $shop['name'], ['class' => 'form-control', 'readonly']) !!}
                </div>
                
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('menu', 'メニュー名') !!}
                    {!! Form::text('menu', old('menu'), ['class' => 'form-control', 'required']) !!}
                </div>
                
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('satisfaction', '満足度') !!}
                    {!! Form::text('satisfaction', old('satisfaction'), ['class' => 'kv-uni-star rating-loading', 'data-size' => 'xl']) !!}
                </div>
                
                <p>タグ（複数可）</p>
                <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: grid; gap: 2px; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));">
                    @foreach($all_tags as $all_tag)
                        <label class="btn btn-outline-danger btn-sm">
                            <input type="checkbox" name="tags[]" value="{{ $all_tag->id }}" autocomplete="off">
                            {{ $all_tag->content }}
                        </label>
                    @endforeach
                </div>
                
                <div class="form-group mt-4">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('image', '写真（1MBまで）') !!}
                    {!! Form::file('image', ['class' => 'form-control-file', 'required', 'onchange' => 'previewImage(this)']) !!}
                </div>
                <p>
                画像プレビュー：<br>
                <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:200px;">
                </p>
                
                
                <div class="form-group">
                    <span class="badge badge-danger">必須</span>
                    {!! Form::label('content', 'コメント') !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'placeholder' => 'レビューを記入してください', 'rows' => '5', 'required']) !!}
                </div>
                
                {!! Form::submit('投稿する', ['class' => 'btn btn-warning btn-block']) !!}
            {!! Form::close() !!}
            
        </div>
    </div>
@endsection