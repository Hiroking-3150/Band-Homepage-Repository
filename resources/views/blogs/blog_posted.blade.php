<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ投稿完了</title>
</head>
<body>
    <div class="container">
        <h1>ブログを投稿しました！</h1>
        <p>あなたのブログが正常に投稿されました。</p>

        <a href="{{ route('blogs.index') }}" class="btn btn-primary">ブログ一覧へ</a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">管理者トップページへ</a>
    </div>
</body>
</html>
