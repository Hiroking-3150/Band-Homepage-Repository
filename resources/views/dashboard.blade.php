<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>管理者ダッシュボード</title>
    </head>
    <body>
        <h1>ようこそ、管理者さん！</h1>
        <p>ここが管理者専用のダッシュボードです。</p>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(auth()->check() && auth()->user()->is_admin)
            <h2>管理者ダッシュボード</h2>
            <!-- <a href="{{ route('blogs.index') }}">ブログ一覧</a> |  -->
            <a href="{{ route('blogs.create') }}">新しいブログを作成</a>
            <a href="{{ route('news.create') }}">ニュース作成</a>
            <a href="{{ route('cds.create') }}">CD情報作成</a>
            <a href="{{ route('schedules.create') }}">ライブ情報作成</a>
        @else
            <p>管理者専用ページにアクセスするためにはログインが必要です。</p>
        @endif

        <a href="/" class="btn btn-primary">トップページへ戻る</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">ログアウト</button>
        </form>
    </body>
</html>
