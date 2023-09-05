<?php

namespace Database\Factories;

use App\Models\Social;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Social::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category' => '1',
            'name' => $this->faker->name(),
            'status' => $this->faker->boolean(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
