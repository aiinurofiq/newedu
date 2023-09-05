<?php

namespace Database\Factories;

use App\Models\Marital;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaritalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Marital::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
