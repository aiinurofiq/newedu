<?php

namespace Database\Factories;

use App\Models\Lpayment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LpaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lpayment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'accnumber' => $this->faker->text(255),
        ];
    }
}
