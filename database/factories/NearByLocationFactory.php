<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\NearByLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class NearByLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NearByLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'img' => $this->faker->text,
            'name' => $this->faker->text,
            'order' => $this->faker->randomNumber(0),
        ];
    }
}
