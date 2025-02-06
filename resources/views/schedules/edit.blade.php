<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ライブスケジュール編集画面</title>
</head>
<body>
    <h1>ライブスケジュール編集画面</h1>
    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>タイトル:</label>
        <!-- <input type="text" name="title" value="{{ $schedule->event_title }}" required> -->
        <input type="text" name="title" value="{{ old('title', $schedule->event_title) }}" required>
        <br>
        <label>日時:</label>
        <input type="date" name="event_date" value="{{ $schedule->event_date }}" required>
        <br>
        <label>詳細</label>
        <!-- <input type="text" name="event_detail" value="{{ $schedule->event_detail }}" required> -->
        <input type="text" name="event_detail" value="{{ old('event_detail', $schedule->event_detail) }}" required>
        <br>
        <button type="submit">保存</button>
    </form>
    <a href="{{ route('schedules.show', $schedule->id) }}">戻る</a>
</body>
</html>