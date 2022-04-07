<?php

namespace Database\Factories;

use App\Models\Villa;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VillaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Villa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text,
            'bhk' => $this->faker->randomNumber(0),
            'sq_feet' => $this->faker->randomNumber(2),
            'land_size' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'thumbnail' => $this->faker->text,
        ];
    }
}
