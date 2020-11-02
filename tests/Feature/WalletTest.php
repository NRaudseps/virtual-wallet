<?php

namespace Tests\Feature;

use App\Models\Wallet;
use Database\Factories\TransactionFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function check_whether_wallet_page_exists()
    {
        $response = $this->get('/wallet');

        $response->assertStatus(200);
    }

    /** @test */
    public function can_see_multiple_wallets()
    {
        $response = $this->get('/wallet/1');

        $response->assertStatus(200);

        $response = $this->get('/wallet/2');

        $response->assertStatus(200);
    }

    /** @test */
    public function can_create_wallet()
    {
//        $wallet = DB::table('wallets')->get();
//        $response = $this->view('wallet.index', ['wallets' => $wallet]);
//
//        $response->dump($wallet);
    }
}
