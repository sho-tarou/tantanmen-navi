@if (count($reviews) > 0)
    <div class="row">
        @foreach ($reviews as $review)
            <div  class="col-sm-6 col-lg-3">
                <div>
                    <div>
                        {{-- 投稿者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $review->user->name, ['user' => $review->user->id]) !!}
                    </div>
                    <div>
                        {{-- この投稿の店舗詳細ページへのリンク --}}
                        {!! link_to_route('shops.show', $review->shop->name, ['shop' => $review->shop->id]) !!}
                    </div>
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
            </div>
        @endforeach
    </div>
    {{-- ページネーションのリンク --}}
    {{ $reviews->links() }}
@endif