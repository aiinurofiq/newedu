<?php

namespace Database\Factories;

use App\Models\Speaker;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpeakerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Speaker::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'organizer' => $this->faker->text(255),
            'year' => $this->faker->year(),
            'address' => $this->faker->address(),
            'description' => $this->faker->sentence(15),
            'status' => $this->faker->boolean(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
