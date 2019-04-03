<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    @if(old('email'))
        <p>認証に失敗しました</p>
    @endif

    <form method="post">
        @csrf
        <input name="email" type="email" value="{{ old('email') }}">
        <input name="password" type="password">
        <button type="submit">ログイン</button>
    </form>
</body>
</html>
