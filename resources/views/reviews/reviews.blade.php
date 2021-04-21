@if (count($reviews) > 0)
    <div class="row">
        @foreach ($reviews as $review)
            <div  class="mt-1 col-sm-6 col-lg-3">
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
                        <div class="review-image">
                            <a href="{{ route('reviews.show', $review->id) }}">
                                <img class="img-thumbnail img-fluid mx-auto d-block" src="https://tantanmen-navi.s3-ap-northeast-1.amazonaws.com/{{ $review->image_url }}" alt="tantanmen image">
                                <div class="review-satisfaction">
                                    <input id="satisfaction" name="satisfaction" value="{{ $review->satisfaction }}" class="kv-uni-star rating-loading" data-readonly="true" data-show-clear="false" data-show-caption="false" data-size="sm">
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
                <div>
                    {{-- タグ --}}
                    @if (count($review->tags) > 0)
                        @foreach ($review->tags as $review->tag)
                            <span class="badge badge-danger">{{ $review->tag->content }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    {{-- ページネーションのリンク --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $reviews->links() }}
    </div>
@endif