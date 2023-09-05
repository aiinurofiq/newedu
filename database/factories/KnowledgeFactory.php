<?php

namespace Database\Factories;

use App\Models\Knowledge;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class KnowledgeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Knowledge::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->unique->uuid(),
            'title' => $this->faker->sentence(10),
            'writer' => $this->faker->text(255),
            'abstract' => $this->faker->text(255),
            'status' => $this->faker->boolean(),
            'user_id' => \App\Models\User::factory(),
            'topic_id' => \App\Models\Topic::factory(),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
