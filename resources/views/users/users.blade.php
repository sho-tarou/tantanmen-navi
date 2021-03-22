@if (count($users) > 0)
    <ul class="list-unstyled list-inline">
        @foreach ($users as $user)
            <li class="list-inline-item">
                {{-- 写真 --}}
                <div style="padding: 30px; margin: 0px; border: 1px solid #333333;">
                    写真
                    <img class="mr-2 rounded" src="" alt="">
                </div>
                <div>
                    {{-- ユーザ詳細ページへのリンク --}}
                    <p>{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</p>
                </div>
            </li>
        @endforeach
    </ul>
@endif