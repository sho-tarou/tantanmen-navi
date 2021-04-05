@extends('layouts.app')

@section('content')
    <div>
        <h2>店舗情報</h2>
        <table class="mt-4 table table-bordered table-striped">
            <tbody>
                <tr>
                    <th width="30%">店名</th>
                    <td>{{ $shop->name }}（{{ $shop->yomi }}）</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $shop->address }}</td>
                </tr>
                <tr>
                    @if($shop->station1)
                        <th>最寄り駅1</th>
                        <td>{{ $shop->railway1 }}{{ $shop->station1 }}駅{{ $shop->walking_time1 ? 'から徒歩' . $shop->walking_time1 . '分' : ''}}</td>
                    @else
                        <th>最寄り駅</th>
                        <td></td>
                    @endif
                </tr>
                @if($shop->station2)
                    <tr>
                        <th>最寄り駅2</th>
                        <td>{{ $shop->railway2 }}{{ $shop->station2 }}駅{{ $shop->walking_time2 ? 'から徒歩' . $shop->walking_time2 . '分' : ''}}</td>
                    </tr>
                @endif
                @if($shop->station3)
                    <tr>
                        <th>最寄り駅3</th>
                        <td>{{ $shop->railway3 }}{{ $shop->station3 }}駅{{ $shop->walking_time3 ? 'から徒歩' . $shop->walking_time3 . '分' : ''}}</td>
                    </tr>
                @endif
                <tr>
                    <th>電話番号</th>
                    <td>{{ $shop->tel }}</td>
                </tr>
                <tr>
                    <th>駐車場</th>
                    @if($shop->parking == true)
                        <td>有り</td>
                    @elseif($shop->parking == null)
                        <td></td>
                    @else
                        <td>無し</td>
                    @endif
                </tr>
                <tr>
                    <th>公式サイト</th>
                    <td><a href={{ $shop->pc_url }}>{{ $shop->pc_url }}</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <p>このお店のレビュー</p>
        <div style="margin: 0px; border: 1px solid #333333;">
            {{-- 投稿一覧 --}}
            @include('reviews.reviews')
        </div>
    </div>
@endsection