<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Wallet</title>
</head>
<body>
<a href="/dashboard">Back</a>
    <form action="{{ route('wallet.create') }}" method="post">
        @csrf
        <label for="name">Enter wallet name</label>
        <textarea name="name" id="name" cols="20" rows="1" style="display: block"></textarea>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
