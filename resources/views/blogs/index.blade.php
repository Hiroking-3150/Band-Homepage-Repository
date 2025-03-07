<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>ブログ一覧画面</h1>

        <!-- @if(auth()->user() && auth()->user()->is_admin)
        <a href='/blogs/create'>Create Page</a>
        @endif -->
       
        <div class='blogs'>
            @foreach ($blogs as $blog)
                <div class='blog'>
                    <h2 class='title'>
                        <a href="/blogs/{{ $blog->id }}">{{ $blog->title }}</a>
                    </h2>
                    <p class="auther">
                        作成者：<a href="">{{ $blog->user ? $blog->user->name : '不明' }}</a>
                    </p>
                    <p class='body'>{{ $blog->body }}</p>
                   
                    @if(auth()->user() && auth()->user()->is_admin)
                    <form action="/blogs/{{ $blog->id }}" id="form_{{ $blog->id }}" method="post">
                         @csrf
                         @method('DELETE')
                        <button type="button" onclick="deleteBlog({{ $blog->id }})">delete</button>
                    </form>
                    @endif  <!-- ここを追加 -->
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $blogs->links() }}
        </div>
        <div class="footer">
            <a href="/">トップページへ戻る</a>
        </div>

        <script>
            function deleteBlog(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>