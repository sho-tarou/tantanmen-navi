<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color:#e93f02;">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">担々麺ナビ</a>
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                {{-- 検索ページへのリンク --}}
                <li class="nav-item nav-link"><a href="#">検索</a></li>
                {{-- 投稿ページへのリンク --}}
                <li class="nav-item nav-link"><a href="#">投稿</a></li>
                
                @if (Auth::check())
                    {{-- マイページへのリンク --}}
                    <li class="nav-item nav-link"><a href="#">マイページ</a></li>
                    {{-- ログアウトへのリンク --}}
                    <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
                @else
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', 'ユーザー登録', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>