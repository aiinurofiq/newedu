<?php

namespace Database\Factories;

use App\Models\Eduhistory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EduhistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Eduhistory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'major' => $this->faker->text(255),
            'year' => $this->faker->year(),
            'academic_degree' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'status' => $this->faker->boolean(),
            'university_id' => \App\Models\University::factory(),
            'city_id' => \App\Models\City::factory(),
            'user_id' => \App\Models\User::factory(),
            'education_id' => \App\Models\Education::factory(),
        ];
    }
}
