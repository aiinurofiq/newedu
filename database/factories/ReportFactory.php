<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

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
