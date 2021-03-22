<h3>{{ $user->name }}さん</h3>
    
<div class="row  mb-3">
    <div class="col-sm-5">
        {{-- ユーザーの写真を表示 --}}
        <div style="padding: 100px; margin: 0px; border: 1px solid #333333;">
            写真
            <img class="mr-2 rounded" src="" alt="">
        </div>
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