<?php

namespace Database\Factories;

use App\Models\VillaImage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VillaImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VillaImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->text,
            'villa_id' => \App\Models\Villa::factory(),
        ];
    }
}
