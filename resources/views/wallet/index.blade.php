<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="/dashboard">Back</a>
    <ul>
        @foreach($wallets as $wallet)
            <a href="{{ route('wallet.show', ['id' => $wallet->id]) }}"><li>{{ $wallet->name }}</li></a>
            <div style="display: inline">
                <form action="/wallet/rename" method="get">
                    <button type="submit" name="id" value="{{ $wallet->id }}">Rename wallet</button>
                </form>
                <form action="{{ route('wallet.delete') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" name="id" value="{{ $wallet->id }}">Delete wallet</button>
                </form>
            </div>
        @endforeach
    </ul>
</body>
</html>
