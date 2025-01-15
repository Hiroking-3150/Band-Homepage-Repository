<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Blog作成画面</title>
    </head>
    <body>
        <h1>ブログ新規作成画面</h1>
        <form action="/blogs" method="POST">
            @csrf
            <div class="user">
                <h2>作成者</h2>
                <select name="blog[users_id]" required>
                <option value="" disabled selected>ユーザーを選択してください</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="title">
                <h2>タイトル</h2>
                <input type="text" name="blog[title]" placeholder="Enter the title" value="{{ old('blog.title') }}"/>
                <p class="title_error" style="color:red">{{ $errors->first('blog.title') }}</p>
            </div>
            <div class="body">
                <h2>本文</h2>
                <textarea name="blog[body]" placeholder="Please enter the text of your blog" value="{{ old('blog.body') }}"></textarea>
                <p class="body_error" style="color:red">{{ $errors->first('blog.body') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="footer">
            <a href="/dashboard">戻る</a>
        </div>
    </body>
</html>