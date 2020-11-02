<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rename Wallet</title>
</head>
<body>
    <form action="{{ route('wallet.rename', ['id' => $_GET['id']]) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $_GET['id'] }}">
        <label for="name">Rename wallet</label>
        <textarea name="name" id="name" cols="20" rows="1" style="display: block"></textarea>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
