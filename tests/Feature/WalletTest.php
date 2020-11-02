<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\Wallet;
use Database\Factories\TransactionFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_see_wallets()
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
        $wallet = Wallet::factory()->create();
        $response = $this->get('/wallet');

        $response->assertSee($wallet->name);
    }

    /** @test */
    public function can_rename_wallet()
    {
        $wallet = Wallet::factory()->create();
        $response = $this->put('/wallet/rename', $wallet->toArray());

        $response->assertDontSee($wallet);
    }

    /** @test */
    public function can_delete_wallet()
    {
        $wallet = Wallet::factory()->create();
        $response = $this->delete('/wallet/delete', $wallet->toArray());

        $response->assertDontSee($wallet);
    }

    /** @test */
    public function can_see_transactions_on_wallet()
    {
        $transaction = Transaction::factory()
            ->state([
                'wallet_id' => 1
            ])->create();
        $response = $this->get('/wallet/' . 1);

        $response->assertSee(number_format($transaction->amount/100, 2));
    }

    /** @test */
    public function can_add_a_transaction_to_a_wallet()
    {
        $transaction = Transaction::factory()
            ->state([
                'wallet_id' => 1
            ])->create();

        $this->post('/transaction/store', $transaction->toArray());
        $response = $this->get('/wallet/1');

        $response->assertSee(number_format($transaction->amount/100, 2));
    }

    /** @test */
    public function can_delete_a_transaction()
    {
        $transaction = Transaction::factory()
            ->state([
                'wallet_id' => 1
            ])->create();
        $this->delete('/transaction/delete', $transaction->toArray());
        $response = $this->get('/wallet/1');

        $response->assertDontSee($transaction);
    }

    /** @test */
    public function can_see_sum_of_all_incoming_transactions()
    {
        $transaction = Transaction::factory()
            ->state([
                'wallet_id' => 1,
                'amount' => 100,
                'incoming_from' => 'Someone'
            ])->count(2)->create();

        $this->get('/wallet/1')->assertSee(2);
    }

    /** @test */
    public function can_see_sum_of_all_outgoing_transactions()
    {
        $transaction = Transaction::factory()
            ->state([
                'wallet_id' => 1,
                'amount' => 100,
                'outgoing_to' => 'Someone'
            ])->count(2)->create();

        $this->get('/wallet/1')->assertSee(2);
    }
//
//    /** @test */
//   Can't get this to work
//    public function can_set_transaction_as_fraudulent()
//    {
//        $transaction = Transaction::factory()
//            ->state([
//                'wallet_id' => 1
//            ])->create();
//        $this->put('/transaction/setAsFraudulent', $transaction->toArray());
//
//        $this->get('/wallet/1')->assertSee('Yes');
//    }
}
