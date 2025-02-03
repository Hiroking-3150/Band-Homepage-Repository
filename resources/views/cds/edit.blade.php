<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ディスコグラフィー編集</title>
</head>
<body>
    <h1>ディスコグラフィーの編集</h1>

    <form action="{{ route('cds.update', $cd->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">タイトル:</label>
        <input type="text" id="title" name="title" value="{{ old('title', $cd->title) }}" required>
        <br>

        <label for="release_date">発売日:</label>
        <input type="date" id="release_date" name="release_date" value="{{ old('release_date', $cd->release_date) }}" required>
        <br>

        <label for="cover_image">カバー画像:</label>
        <input type="file" id="cover_image" name="cover_image">
        @if($cd->cover_image)
            <br>
            <img src="{{ $cd->cover_image }}" alt="カバー画像" width="100">
        @endif
        <br>

        <div class="songs">
            <h2>収録曲</h2>
            <div id="song-fields">
                @foreach($cd->songs as $index => $song)
                    <div class="song">
                        <input type="text" name="songs[{{ $index }}][title]" value="{{ $song->title }}" placeholder="曲名" required />
                        <button type="button" class="remove-song">削除</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-song">収録曲を追加</button>
        </div>

        <button type="submit">更新</button>
    </form>

    <a href="{{ route('cds.index') }}">戻る</a>

    <script>
        // 収録曲の追加
        document.getElementById('add-song').addEventListener('click', function () {
            var songFields = document.getElementById('song-fields');
            var songCount = songFields.querySelectorAll('.song').length;
            var newSongDiv = document.createElement('div');
            newSongDiv.classList.add('song');
            newSongDiv.innerHTML = `
                <input type="text" name="songs[${songCount}][title]" placeholder="曲名" required />
                <button type="button" class="remove-song">削除</button>
            `;
            songFields.appendChild(newSongDiv);
        });

        // 収録曲の削除
        document.getElementById('song-fields').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-song')) {
                e.target.closest('.song').remove();
            }
        });
    </script>


</body>
</html>
