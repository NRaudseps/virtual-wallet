<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store()
    {
        DB::table('transactions')->insert([
            'user_id' => Auth::id(),
            'wallet_id' => $_POST['id'],
            'amount' => $_POST['amount']*100,
            'incoming_from' => 'Me',
            'outgoing_to' => $_POST['send_to'],
            'is_fraudulent' => false
        ]);

        return redirect()->route('wallet.show', ['id' => $_POST['id']]);
    }

    public function delete()
    {
        foreach($_POST['id'] as $id) {
            DB::table('transactions')
                ->where(['id' => $id])
                ->delete();
        }

        return redirect()->route('wallet.show', ['id' => $_POST['true_id']]);
    }

    public function setAsFraudulent()
    {
        foreach($_POST['check'] as $check) {
            DB::table('transactions')
                ->where(['id' => $check])
                ->update(['is_fraudulent' => 1]);
        }

        return redirect()->route('wallet.show', ['id' => $_POST['true_id']]);

    }
}
