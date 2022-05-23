<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\HomepageSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomepageSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HomepageSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_title' => $this->faker->text(255),
            'project_location' => $this->faker->text(255),
            'rera_number' => $this->faker->text,
            'youtube_link' => $this->faker->text,
            'brochure' => $this->faker->text,
            'project_overview' => $this->faker->text,
            'project_type' => $this->faker->text(255),
            'project_status' => $this->faker->text(255),
            'address_line_1' => $this->faker->text,
            'address_line_2' => $this->faker->text,
            'contact_number' => $this->faker->text(255),
            'logo' => $this->faker->text,
            'email' => $this->faker->email,
            'footer_description' => $this->faker->text,
            'youtube_link_2' => $this->faker->text,
            'youtube_link_3' => $this->faker->text,
        ];
    }
}
