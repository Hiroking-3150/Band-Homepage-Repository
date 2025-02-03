<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $schedule->event_title }}</title>
</head>
<body>
    <h1>{{ $schedule->event_title }}</h1>
    <p><strong>日時:</strong> {{ \Carbon\Carbon::parse($schedule->event_datetime)->format('Y-m-d H:i') }}</p>
    <p><strong>場所:</strong> {{ $schedule->event_location }}</p>
    <p><strong>詳細:</strong> {{ $schedule->event_detail }}</p>
    
    <a href="{{ url('/') }}">戻る</a>
</body>
</html>