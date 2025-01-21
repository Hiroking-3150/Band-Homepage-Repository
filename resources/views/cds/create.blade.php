<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CD情報作成</title>
    </head>
    <body>
        <h1>CD情報作成</h1>
        <form action="{{ route('cds.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>タイトル</h2>
                <input type="text" name="title" placeholder="タイトル" required />
            </div>

            <div class="release_date">
                <h2>発売日</h2>
                <input type="date" name="release_date" required />
            </div>

            <div class="cover_image">
                <h2>カバー画像</h2>
                <input type="file" name="cover_image" required />
            </div>

            <!-- ここを追加 -->
            <div class="songs">
            <h2>収録曲</h2>
            <div class="song">
                <input type="text" name="songs[0][title]" placeholder="曲名" required />
            </div>
            <div id="song-fields"></div>
            <button type="button" id="add-song">収録曲を追加</button>
            </div>
            <!-- ここまで追加 -->

            <input type="submit" value="保存" />
        </form>

        <div class="footer">
            <a href="{{ route('cds.index') }}">戻る</a>
        </div>

        <!-- ここから追加 -->
        <script>
        // 収録曲を追加するボタンの動作
            document.getElementById('add-song').addEventListener('click', function() {
                const songFields = document.getElementById('song-fields');
                const songIndex = songFields.children.length;
                const newSongField = document.createElement('div');
                newSongField.classList.add('song');
                newSongField.innerHTML = `<input type="text" name="songs[${songIndex}][title]" placeholder="曲名" required />`;
                songFields.appendChild(newSongField);
            });
        </script>
        <!-- ここまで追加 -->
    </body>
</html>
