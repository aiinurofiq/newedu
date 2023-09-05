<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'position' => $this->faker->text(255),
            'start' => $this->faker->date(),
            'end' => $this->faker->date(),
            'description' => $this->faker->sentence(15),
            'status' => $this->faker->boolean(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
