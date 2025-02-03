<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $cd->name }} - 詳細</title>
</head>
<body>
    <h1>{{ $cd->title }}</h1>

    <h2>収録曲</h2>
    <ul>
        @foreach ($cd->songs as $song)
            <li>{{ $song->title }}</li>
        @endforeach
    </ul>

    <div>
        <img src="{{ $cd->cover_image }}" alt="Comming soon..">
    </div>

    <p>発売日: {{ $cd->release_date }}</p>

    @if($isAdmin)
        <a href="{{ route('cds.edit', $cd->id) }}">編集</a>
    @endif

    <form action="{{ route('cds.destroy', $cd->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
        @csrf
        @method('DELETE')

        @if($isAdmin)
            <button type="submit" style="background-color: red; color: white;">削除</button>
        @endif
    </form>

    <a href="{{ route('cds.index') }}">一覧へ戻る</a>

</body>
</html>
