<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        return view('wallet.index');
    }

    public function show()
    {
        return view('wallet.show');
    }
}