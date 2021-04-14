@if (count($users) > 0)
    <div class="row">
        @foreach ($users as $user)
            <div  class="mt-3 col-sm-6 col-lg-3">
                {{-- 写真 --}}
                <div>
                    @if ($user->image_url == null)
                        {{-- デフォルト写真を表示 --}}
                        <img class="rounded-circle img-thumbnail img-fluid mx-auto d-block" src="{{ asset('/assets/images/profile_default_350px.png') }}" alt="profile image">
                    @else
                        {{-- ユーザーの写真を表示 --}}
                        <img class="rounded-circle img-thumbnail img-fluid mx-auto d-block" src="https://tantanmen-navi.s3-ap-northeast-1.amazonaws.com/{{ $user->image_url }}" alt="profile image">
                    @endif
                </div>
                <div>
                    {{-- ユーザ詳細ページへのリンク --}}
                    <p>{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</p>
                </div>
            </div>
        @endforeach
    </div>
@endif