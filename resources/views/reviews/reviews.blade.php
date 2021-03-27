@if (count($reviews) > 0)
    <ul class="list-unstyled">
        @foreach ($reviews as $review)
            <li>
                <div>
                    {{-- 投稿者のユーザ詳細ページへのリンク --}}
                    {!! link_to_route('users.show', $review->user->name, ['user' => $review->user->id]) !!}
                    <p>店名</p>
                    
                    {{-- 投稿写真を表示 --}}
                    @if ($review->image_url == null)
                        {{-- デフォルト写真を表示 --}}
                        <a href="{{ route('reviews.show', $review->id) }}">
                            <img class="img-thumbnail img-fluid mx-auto d-block" src="{{ asset('/assets/images/profile_default_350px.png') }}" alt="tantanmen image">
                        </a>
                    @else
                        {{-- 担々麺の写真（リンク）を表示 --}}
                        <a href="{{ route('reviews.show', $review->id) }}">
                            <img class="img-thumbnail img-fluid mx-auto d-block" src="https://tantanmen-navi.s3-ap-northeast-1.amazonaws.com/{{ $review->image_url }}" alt="tantanmen image">
                        </a>
                    @endif
                </div>
                <div>
                    {{-- タグ --}}
                    <p>tag</p>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $reviews->links() }}
@endif