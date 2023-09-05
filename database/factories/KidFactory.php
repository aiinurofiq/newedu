<?php

namespace Database\Factories;

use App\Models\Kid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class KidFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kid::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'birth' => $this->faker->date(),
            'job' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'status' => $this->faker->boolean(),
            'gender_id' => \App\Models\Gender::factory(),
            'city_id' => \App\Models\City::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
