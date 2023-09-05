<?php

namespace Database\Factories;

use App\Models\Valvision;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ValvisionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Valvision::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->text(255),
            'vision' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
