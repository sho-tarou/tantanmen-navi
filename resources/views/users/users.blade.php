@if (count($users) > 0)
    <ul class="list-unstyled list-inline">
        @foreach ($users as $user)
            <li class="list-inline-item">
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
            </li>
        @endforeach
    </ul>
@endif