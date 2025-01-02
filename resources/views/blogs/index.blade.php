<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Member's Blog</h1>
        <a href='/blogs/create'>Create Page</a>
        <div class='blogs'>
            @foreach ($blogs as $blog)
                <div class='blog'>
                    <h2 class='title'>
                        <a href="/blogs/{{ $blog->id }}">{{ $blog->title }}</a>
                    </h2>
                        <p class='body'>{{ $blog->body }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $blogs->links() }}
        </div>
    </body>
</html>