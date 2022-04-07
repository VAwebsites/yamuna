<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\BrochureRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrochureRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BrochureRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(255),
            'email' => $this->faker->email,
            'phone' => $this->faker->text(255),
        ];
    }
}
