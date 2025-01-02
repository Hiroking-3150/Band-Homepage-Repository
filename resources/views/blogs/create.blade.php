<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Create Blog</title>
    </head>
    <body>
        <h1>Create Blog</h1>
        <form action="/blogs" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="blog[title]" placeholder="Enter the title" value="{{ old('blog.title') }}"/>
                <p class="title_error" style="color:red">{{ $errors->first('blog.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="blog[body]" placeholder="Please enter the text of your blog" value="{{ old('blog.body') }}"></textarea>
                <p class="body_error" style="color:red">{{ $errors->first('blog.body') }}</p>
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/">Back</a>
        </div>
    </body>
</html>