<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Fieldofposition;
use Illuminate\Database\Eloquent\Factories\Factory;

class FieldofpositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fieldofposition::class;

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
