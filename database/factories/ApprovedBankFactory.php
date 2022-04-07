<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ApprovedBank;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApprovedBankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApprovedBank::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'logo' => $this->faker->text,
            'homepage_setting_id' => \App\Models\HomepageSetting::factory(),
        ];
    }
}
