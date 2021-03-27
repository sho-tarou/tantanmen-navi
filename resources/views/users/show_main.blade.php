<h3>{{ $user->name }}さん</h3>
    
<div class="row  mb-3">
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
        @if (Auth::id() == $user->id)
        {{-- 投稿ボタン --}}
        <button class="btn btn-warning btn-block">新しいレビューを投稿する</button>
        @endif
    </div>
</div>