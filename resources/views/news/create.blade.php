<h2>ニュース作成欄(臨時)</h2>
        <form action="/news" method="POST">
            @csrf
            <label for="title">タイトル：</label>
            <input type="text" name="title" id="title" required>
            

            <label for="body">本文:</label>
            <textarea name="body" id="body" required></textarea>


            <label for="schedules_id">スケジュールID (任意):</label>
            <input type="number" name="schedules_id" id="schedules_id">


            <button type="submit">作成</button>
        </form>
