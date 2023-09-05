<?php

namespace Database\Factories;

use App\Models\Reqknowstat;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReqknowstatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reqknowstat::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => '0',
            'description' => $this->faker->sentence(15),
            'reqknowledge_id' => \App\Models\Reqknowledge::factory(),
        ];
    }
}
