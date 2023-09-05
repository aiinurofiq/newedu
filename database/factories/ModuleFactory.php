<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Module::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(10),
            'videoembed' => $this->faker->text(255),
            'text' => $this->faker->text(),
            'description' => $this->faker->sentence(15),
            'duration' => $this->faker->randomNumber(0),
            'section_id' => \App\Models\Section::factory(),
        ];
    }
}
