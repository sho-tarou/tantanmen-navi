<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>TantanmenNavi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="opt/css/star-rating.css" media="all" type="text/css"/>
        <link rel="stylesheet" href="opt/css/themes/krajee-svg/theme.css" media="all" type="text/css"/>
        <link rel="stylesheet" href="opt/css/themes/krajee-uni/theme.css" media="all" type="text/css"/>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="opt/js/star-rating.js" type="text/javascript"></script>
        <script src="opt/js/themes/krajee-svg/theme.js" type="text/javascript"></script>
        <script src="opt/js/themes/krajee-uni/theme.js" type="text/javascript"></script>
        <script src = "opt/js/locales/es.js"></script>
    </head>
    
    <body>
        {{-- ナビゲーションバー --}}
        @include('commons.navbar')
        
        <div id="wrapper">
            <div class="container">
                {{-- エラーメッセージ --}}
                @include('commons.error_messages')
                
                @yield('content')
            </div>
        </div>
        
        <footer class="text-center" style="background-color:#e93f02;">
            <small>&copy; SHOMA ITEZONO</small>
        </footer>
        
        {{-- star ratingのscript --}}
        <script>
            /*global $*/
            $(document).on('ready', function () {
                $('.kv-uni-star').rating({
                    theme: 'krajee-uni',
                    filledStar: '&#x2605;',
                    emptyStar: '&#x2606;'
                });
                $('.kv-svg').rating({
                    theme: 'krajee-svg',
                    filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
                    emptyStar: '<span class="krajee-icon krajee-icon-star"></span>'
                });
                $('.rating,.kv-uni-star').on(
                        'change', function () {
                            console.log('Rating selected: ' + $(this).val());
                        });
            });
        </script>
        
    </body>
</html>