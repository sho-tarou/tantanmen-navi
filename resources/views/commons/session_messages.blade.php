{{-- ユーザー新規登録後のメッセージ --}}
@if(Session::has('register_user'))
    <p class="alert alert-success" role="alert">{{session('register_user')}}</p>
@endif

{{-- ログイン後のメッセージ --}}
@if(Session::has('login'))
    <p class="alert alert-success" role="alert">{{session('login')}}</p>
@endif

{{-- ログアウト後のメッセージ --}}
@if(Session::has('logout'))
    <p class="alert alert-danger" role="alert">{{session('logout')}}</p>
@endif

{{-- ユーザー情報更新後のメッセージ --}}
@if(Session::has('updated_user'))
    <p class="alert alert-success" role="alert">{{session('updated_user')}}</p>
@endif

{{-- ユーザー登録削除後のメッセージ --}}
@if(Session::has('deleted_user'))
    <p class="alert alert-danger" role="alert">{{session('deleted_user')}}</p>
@endif

{{-- 新規投稿後のメッセージ --}}
@if(Session::has('created_review'))
    <p class="alert alert-success" role="alert">{{session('created_review')}}</p>
@endif

{{-- 投稿編集後のメッセージ --}}
@if(Session::has('updated_review'))
    <p class="alert alert-success" role="alert">{{session('updated_review')}}</p>
@endif

{{-- 投稿削除後のメッセージ --}}
@if(Session::has('deleted_review'))
    <p class="alert alert-danger" role="alert">{{session('deleted_review')}}</p>
@endif