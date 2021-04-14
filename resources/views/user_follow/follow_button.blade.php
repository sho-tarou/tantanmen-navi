@if (Auth::check())
    @if (Auth::id() != $user->id)
        @if (Auth::user()->is_following($user->id))
            {{-- アンフォローボタンのフォーム --}}
            {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
                {!! Form::submit('フォロー中', ['class' => "btn btn-primary mx-auto d-block"]) !!}
            {!! Form::close() !!}
        @else
            {{-- フォローボタンのフォーム --}}
            {!! Form::open(['route' => ['user.follow', $user->id]]) !!}
                {!! Form::submit('フォローする', ['class' => "btn btn-outline-primary mx-auto d-block"]) !!}
            {!! Form::close() !!}
        @endif
    @endif
@endif