<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>TOP</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        
        <h1>トップ</h1>

        <a href="{{ route('login') }}">ログイン</a>


        <!-- ニュースセクション　-->
        <h2>ニュース</h2>
        <div class="news-list">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if($news->isEmpty())
                <p>現在、ニュースはございません。</p>
            @else
                @foreach ($news as $item)
                    <div class="news-item">
                        <h3>{{ $item->title }}</h3>
                        <p>{{ $item->body }}</p>
                        <small>投稿日: {{ $item->created_at->format('Y年m月d日 H:i') }}</small>
                        @auth
                            @if (Auth::user()->is_admin)
                                <a href="{{ route('news.edit', $item->id) }}">編集</a>
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                @endforeach
            @endif
        </div>

        <!-- <h2>ニュース作成欄(臨時)</h2>
        <form action="/news" method="POST">
            @csrf
            <label for="title">タイトル：</label>
            <input type="text" name="title" id="title" required>
            

            <label for="body">本文:</label>
            <textarea name="body" id="body" required></textarea>


            <label for="schedules_id">スケジュールID (任意):</label>
            <input type="number" name="schedules_id" id="schedules_id">


            <button type="submit">作成</button>
        </form> -->


        <div class='tops'>
            <h2>ここにそれぞれのページに飛べるようにリンクを貼る</h2>
            <p><a href="/blogs">ブログ一覧</a></p>
            <p><a href="{{ route('schedules.index') }}">ライブスケジュール</a></p>
            <p><a href="/cds">ディスコグラフィー</a></p>
        </div>
    </body>
</html>