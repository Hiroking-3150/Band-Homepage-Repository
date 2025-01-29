<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規予定作成</title>
    <!-- 必要なCSSやスタイルをここに追加 -->
    <link rel="stylesheet" href="path/to/your/css/style.css">
</head>
<body>
    <div class="container">
        <h1>新規予定作成</h1>

        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="event_title">タイトル</label>
                <input type="text" name="event_title" id="event_title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="event_datetime">日付</label>
                <input type="date" name="event_datetime" id="event_datetime" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="event_detail">詳細</label>
                <textarea name="devent_detail" id="event_detail" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">予定を追加</button>
        </form>
    </div>

    <!-- 必要なJSスクリプトをここに追加 -->
    <script src="path/to/your/js/script.js"></script>

    <div class="footer">
            <a href="/dashboard">管理者ダッシュボードに戻る</a>
    </div>
</body>
</html>
