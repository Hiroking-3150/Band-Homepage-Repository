<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ニュース編集</title>
</head>
<body>
    <h1>ニュース編集画面</h1>

    <form action="{{ route('news.update', $news->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- タイトル -->
        <label for="title">タイトル:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}">
        @error('title')<div style="color: red;">{{ $message }}</div>@enderror
        <br>

        <!-- 本文 -->
        <label for="body">本文:</label>
        <textarea name="body" id="body">{{ old('body', $news->body) }}</textarea>
        @error('body')<div style="color: red;">{{ $message }}</div>@enderror
        <br>

        <!-- スケジュールID -->
        <label for="schedules_id">スケジュールID:</label>
        <input type="number" name="schedules_id" id="schedules_id" value="{{ old('schedules_id', $news->schedules_id) }}">
        @error('schedules_id')<div style="color: red;">{{ $message }}</div>@enderror
        <br>

        <button type="submit">更新</button>
    </form>

    <br>
    <a href="{{ route('top') }}">ニュース一覧に戻る</a>
</body>
</html>