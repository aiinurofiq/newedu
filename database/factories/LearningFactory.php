<?php

namespace Database\Factories;

use App\Models\Learning;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LearningFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Learning::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->unique->uuid(),
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
            'type' => '0',
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'level' => '0',
            'ispublic' => $this->faker->boolean(),
            'user_id' => \App\Models\User::factory(),
            'categorylearn_id' => \App\Models\Categorylearn::factory(),
        ];
    }
}
