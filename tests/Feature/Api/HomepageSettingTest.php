<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\HomepageSetting;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomepageSettingTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_homepage_settings_list()
    {
        $homepageSettings = HomepageSetting::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.homepage-settings.index'));

        $response->assertOk()->assertSee($homepageSettings[0]->project_title);
    }

    /**
     * @test
     */
    public function it_stores_the_homepage_setting()
    {
        $data = HomepageSetting::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.homepage-settings.store'),
            $data
        );

        $this->assertDatabaseHas('homepage_settings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_homepage_setting()
    {
        $homepageSetting = HomepageSetting::factory()->create();

        $data = [
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
        ];

        $response = $this->putJson(
            route('api.homepage-settings.update', $homepageSetting),
            $data
        );

        $data['id'] = $homepageSetting->id;

        $this->assertDatabaseHas('homepage_settings', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_homepage_setting()
    {
        $homepageSetting = HomepageSetting::factory()->create();

        $response = $this->deleteJson(
            route('api.homepage-settings.destroy', $homepageSetting)
        );

        $this->assertModelMissing($homepageSetting);

        $response->assertNoContent();
    }
}
