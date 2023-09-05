<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->text(255),
            'cutprice' => $this->faker->randomNumber(2),
            'typecut' => 'percentage',
            'maxcut' => $this->faker->randomNumber(2),
            'maxusage' => $this->faker->randomNumber(0),
            'expireddate' => $this->faker->date(),
        ];
    }
}
