<?php

namespace Database\Factories;

use App\Models\Position;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Position::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'start' => $this->faker->date(),
            'end' => $this->faker->date(),
            'status' => $this->faker->boolean(),
            'fieldofposition_id' => \App\Models\Fieldofposition::factory(),
            'user_id' => \App\Models\User::factory(),
            'division_id' => \App\Models\Division::factory(),
        ];
    }
}
