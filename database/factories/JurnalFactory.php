<?php

namespace Database\Factories;

use App\Models\Jurnal;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JurnalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jurnal::class;

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
