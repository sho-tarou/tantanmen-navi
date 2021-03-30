<h3>{{ $user->name }}さん</h3>
    
<div class="row mb-5">
    <div class="col-sm-5">
        @if ($user->image_url == null)
            {{-- デフォルト写真を表示 --}}
            <img class="rounded-circle img-thumbnail img-fluid mx-auto d-block" src="{{ asset('/assets/images/profile_default_350px.png') }}" alt="profile image">
        @else
            {{-- ユーザーの写真を表示 --}}
            <img class="rounded-circle img-thumbnail img-fluid mx-auto d-block" src="https://tantanmen-navi.s3-ap-northeast-1.amazonaws.com/{{ $user->image_url }}" alt="profile image">
        @endif
            
        {{-- フォロー／アンフォローボタン --}}
        @include('user_follow.follow_button')
    </div>
    
    <div class="col-sm-7">
        @if (Auth::check())
            @if (Auth::id() == $user->id)
                {{-- プロフィール編集ページへのリンク --}}
                <div class="text-right">
                    {!! link_to_route('users.edit', '登録情報を変更する', ['user' => $user->id], ['class' => 'text-muted']) !!}
                </div>
                {{-- 投稿ページへのリンク --}}
                <div class="d-flex align-items-center justify-content-center h-100">
                {!! link_to_route('reviews.create', 'レビューを投稿する', [], ['class' => 'btn btn-warning btn-inline-block']) !!}
                </div>
            @endif
        @endif
    </div>
</div>