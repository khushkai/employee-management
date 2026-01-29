<?php

namespace Database\Factories;
use App\Models\Test; 
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'age'  => $this->faker->numberBetween(18, 40),
        ];
    }
}
