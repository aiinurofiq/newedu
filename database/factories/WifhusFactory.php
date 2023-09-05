<?php

namespace Database\Factories;

use App\Models\Wifhus;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WifhusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wifhus::class;

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
            'as' => '1',
            'job' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'maritaldate' => $this->faker->date(),
            'status' => $this->faker->boolean(),
            'city_id' => \App\Models\City::factory(),
            'gender_id' => \App\Models\Gender::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
