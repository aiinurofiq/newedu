<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'au' => [],
            'question_id' => \App\Models\Question::factory(),
        ];
    }
}
