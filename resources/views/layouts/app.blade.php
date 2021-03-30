<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>TantanmenNavi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        {{-- star ratingのcss --}}
        <link rel="stylesheet" href="/css/star-rating.css" media="all" type="text/css"/>
        <link rel="stylesheet" href="/css/themes/krajee-uni/theme.css" media="all" type="text/css"/>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        {{-- star ratingのjavascript --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="/js/star-rating.js" type="text/javascript"></script>
        <script src="/js/themes/krajee-uni/theme.js" type="text/javascript"></script>
        
        {{-- star ratingのjavascript --}}
        <script>
            /*global $*/
            $(document).on('ready', function () {
                $('.kv-uni-star').rating({
                    theme: 'krajee-uni',
                    filledStar: '&#x2605;',
                    emptyStar: '&#x2606;'
                });
                $('.rating,.kv-uni-star').on(
                        'change', function () {
                            console.log('Rating selected: ' + $(this).val());
                        });
            });
        </script>
    </head>
    
    <body>
        {{-- ナビゲーションバー --}}
        @include('commons.navbar')
        
        <div id="wrapper">
            <div class="container">
                {{-- エラーメッセージ --}}
                @include('commons.error_messages')
                {{-- ユーザー登録削除後のメッセージ --}}
                @if(Session::has('deleted_user'))
                    <p class="bg-danger">{{session('deleted_user')}}</p>
                @endif
                {{-- 投稿削除後のメッセージ --}}
                @if(Session::has('deleted_review'))
                    <p class="bg-danger">{{session('deleted_review')}}</p>
                @endif
                
                @yield('content')
            </div>
        </div>
        
        <footer class="text-center" style="background-color:#e93f02;">
            <small>&copy; SHOMA ITEZONO</small>
        </footer>
    </body>
</html>