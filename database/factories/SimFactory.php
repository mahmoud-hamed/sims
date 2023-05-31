<?php

namespace Database\Factories;

use App\Models\Sim;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sim>
 */
class SimFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Sim::class;

    public function definition(): array
    {
        return [
            'number' => $this->faker->phoneNumber,
            'type' => $this->faker->randomElement(['zain', 'mobily', 'stc']),
            'period' => $this->faker->randomElement(['month', '3months', '6months', 'year']),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'serial' => $this->faker->unique()->uuid,

        ];
    }
}
