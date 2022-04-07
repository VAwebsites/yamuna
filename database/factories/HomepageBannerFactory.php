<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\HomepageBanner;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomepageBannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HomepageBanner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'banner' => $this->faker->text,
            'homepage_setting_id' => \App\Models\HomepageSetting::factory(),
        ];
    }
}
