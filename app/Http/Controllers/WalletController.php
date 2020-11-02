<?php

namespace App\Http\Controllers;

use Faker\Provider\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Wallet;
use App\Models\Transaction;

class WalletController extends Controller
{
    public function index()
    {
        $wallets = Wallet::all();

        return view('wallet.index', ['wallets' => $wallets]);
    }

    public function show($id)
    {
        $transactions = Transaction::all()->where('wallet_id', $id);

        $sumOfIncoming = 0;
        $sumOfOutgoing = 0;
        foreach ($transactions as $transaction) {
            if($transaction->incoming_from !== 'Me'){
                $sumOfIncoming += $transaction->amount;
            }
            else {
                $sumOfOutgoing += $transaction->amount;
            }
        }

        return view('wallet.show', [
            'id' => $id,
            'transactions' => $transactions,
            'sumOfIncoming' => $sumOfIncoming,
            'sumOfOutgoing' => $sumOfOutgoing
        ]);
    }

    public function create()
    {
        DB::table('wallets')->insert([
            'user_id' => Auth::id(),
            'name' => $_POST['name']
        ]);

        return view('/dashboard');
    }

    public function rename()
    {
        DB::table('wallets')
            ->where(['id' => $_POST['id']])
            ->update(['name' => $_POST['name']]);

        return redirect()->route('wallet.index');
    }

    public function delete()
    {
        DB::table('wallets')
            ->where(['id' => $_POST['id']])
            ->delete();

        return redirect()->route('wallet.index');
    }
}
