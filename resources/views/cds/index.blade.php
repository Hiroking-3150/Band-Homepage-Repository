<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discography</title>
</head>
<body>
    <h1>Discography</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Title</th>
                <th>Release Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cds as $cd)
                <tr>
                    <td><a href="{{ route('cds.show', $cd->id) }}">{{ $cd->title }}</a></td>
                    <td>{{ $cd->release_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
<div class="footer">
    <a href="/">トップページへ戻る</a>
 </div>
</html>
