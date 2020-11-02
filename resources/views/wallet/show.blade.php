<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wallet</title>
</head>
<body>
<a href="{{ route('wallet.index') }}">Back to Wallet Section</a>
<h3>Send a transaction</h3>
<form action="/transaction/store" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <label for="send_to" style="display: block">Send Transaction To</label>
    <input type="text" name="send_to">
    <label for="amount" style="display: block">How much (in dollars)</label>
    <input type="text" name="amount">
    <button type="submit" style="display: block">Submit</button>
</form>
<div style="height: 30px;"></div>
<ul>
    <h3>Incoming Transactions</h3>
    <form action="/transaction/setAsFraudulent" method="post">
        @csrf
        @method('PUT')
        @foreach($transactions as $transaction)
            @if($transaction->incoming_from !== 'Me')
                <li>
                    <h4>Incoming From: {{ $transaction->incoming_from }} - {{ number_format($transaction->amount/100, 2) }}$</h4>
                    <label for="check" style="display: inline-block">Check As Fraudulent?</label>
                    <input type="hidden" name="true_id" value="{{ $id }}">
                    <input type="checkbox" name="check[]" value="{{ $transaction->id }}">
                    <p>Checked as Fraudulent: {{ ($transaction->is_fraudulent) ? 'Yes' : 'No' }}</p>

                </li>
            @endif
        @endforeach
        <button type="submit" style="display: block">Submit</button>
    </form>
    <p>Sum of all incoming transactions: {{ number_format($sumOfIncoming/100, 2) }}$</p>

    <br>
    <br>

    <h3>Outgoing Transactions</h3>
    <form action="/transaction/delete" method="post">
        @csrf
        @method('DELETE')
        @foreach($transactions as $transaction)
            @if($transaction->incoming_from === 'Me')
                <li><h4>Outgoing To: {{ $transaction->outgoing_to }} - {{ number_format($transaction->amount/100, 2) }}$</h4></li>
                    <label for="id">Delete Transaction</label>
                    <input type="hidden" name="true_id" value="{{ $id }}">
                    <input type="checkbox" name="id[]" value="{{ $transaction->id }}">
            @endif
        @endforeach
        <button type="submit" style="display: block; margin-top: 20px;">Submit</button>
    </form>
    <p>Sum of all outgoing transactions: {{ number_format($sumOfOutgoing/100, 2) }}$</p>
</ul>
</body>
</html>
