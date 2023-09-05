<?php

namespace Database\Factories;

use App\Models\Exsum;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExsumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exsum::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'knowledge_id' => \App\Models\Knowledge::factory(),
        ];
    }
}
