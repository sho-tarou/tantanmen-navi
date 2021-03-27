@if (Auth::check())
    @if (Auth::user()->is_favoring($review->id))
        {{-- お気に入り削除ボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $review->id], 'method' => 'delete']) !!}
            {!! Form::submit('お気に入り中', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {{-- お気に入り追加ボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $review->id]]) !!}
            {!! Form::submit('お気に入りする', ['class' => "btn btn-outline-danger btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif