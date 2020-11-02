<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;


class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'wallet_id' => 1,
            'amount' => $this->faker->randomFloat(),
            'incoming_from' => $this->faker->name,
            'outgoing_to' => $this->faker->name,
            'is_fraudulent' => false
        ];
    }
}
