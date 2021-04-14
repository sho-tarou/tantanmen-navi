<div class="text-center m-5">
    <h3>ユーザー詳細</h3>
</div>

<div class="row mb-5">
    @if (Auth::id() == $user->id)
        <div class="col-sm-6">
    @else
        <div class="offset-sm-3 col-sm-6">
    @endif
    
        <div class="text-center">
            <h4>{{ $user->name }}さん</h4>
            
            @if ($user->image_url == null)
                {{-- デフォルト写真を表示 --}}
                <img class="rounded-circle img-thumbnail img-fluid mx-auto d-block" src="{{ asset('/assets/images/profile_default_350px.png') }}" alt="profile image">
            @else
                {{-- ユーザーの写真を表示 --}}
                <img class="rounded-circle img-thumbnail img-fluid mx-auto d-block" src="https://tantanmen-navi.s3-ap-northeast-1.amazonaws.com/{{ $user->image_url }}" alt="profile image">
            @endif
                
            {{-- フォロー／アンフォローボタン --}}
            <div class="mt-1">
                @include('user_follow.follow_button')
            </div>
        </div>
    </div>
    
    @if (Auth::check())
        @if (Auth::id() == $user->id)
            <div class="col-sm-6">
                {{-- プロフィール編集ページへのリンク --}}
                <div class="text-right">
                    {!! link_to_route('users.edit', '登録情報を変更する', ['user' => $user->id], ['class' => 'text-muted']) !!}
                </div>
                {{-- 投稿ページへのリンク --}}
                <div class="d-flex align-items-center justify-content-center h-100">
                {!! link_to_route('reviews.create', '新しいレビューを投稿する', [], ['class' => 'btn btn-warning btn-inline-block btn-lg']) !!}
                </div>
            </div>
        @endif
    @endif
</div>