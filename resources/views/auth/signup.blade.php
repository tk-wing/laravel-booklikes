<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サインアップ</title>
</head>
<body>
    <ul>
    </ul>

    <form method="post">
        @csrf

        <p>
        Eメールアドレス: <input name="email" type="email" value="{{ old('email') }}">
        </p>
        @if($errors->has('email'))
            <ul>
                @foreach($errors->get('email') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif

        <p>
            パスワード: <input name="password" type="password">
        </p>
        @if($errors->has('password'))
            <ul>
                @foreach($errors->get('password') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif

        <p>
            パスワードの確認: <input name="password_confirmation" type="password">
        </p>
        @if($errors->has('password_confirmation'))
            <ul>
                @foreach($errors->get('password_confirmation') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif

        <button type="submit">登録する</button>
    </form>
    @php dd($errors->all()) @endphp
</body>
</html>
