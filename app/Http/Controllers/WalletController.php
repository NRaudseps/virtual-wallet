<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function index()
    {
        $wallets = DB::table('wallets')->get();

        return view('wallet.index', ['wallets' => $wallets]);
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
