<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blogs</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">
            {{ $blog->title }}
        </h1>

        <p class="author">
        作成者：<a href="">{{ $blog->user->name }}</a>
        </p>
        
        <div class="content">
            <div class="content__blog">
                <h3>本文</h3>
                <p>{{ $blog->body }}</p>    
            </div>
        </div>
        <div class="edit">
            @if(Auth::check() && Auth::user()->is_admin)
            <a href="/blogs/{{ $blog->id }}/edit">編集</a>
            @endif
        </div>
        <div class="footer">
            <a href="/blogs">戻る</a>
        </div>
    </body>
</html>