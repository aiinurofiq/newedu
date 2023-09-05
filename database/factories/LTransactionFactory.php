<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\LTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class LTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'status' => '0',
            'totalamount' => $this->faker->randomNumber(2),
            'user_id' => \App\Models\User::factory(),
            'learning_id' => \App\Models\Learning::factory(),
            'lpayment_id' => \App\Models\Lpayment::factory(),
            'coupon_id' => \App\Models\Coupon::factory(),
        ];
    }
}
