<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\HomepageSetting;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomepageSettingControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_homepage_settings()
    {
        $homepageSettings = HomepageSetting::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('homepage-settings.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.homepage_settings.index')
            ->assertViewHas('homepageSettings');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_homepage_setting()
    {
        $response = $this->get(route('homepage-settings.create'));

        $response->assertOk()->assertViewIs('app.homepage_settings.create');
    }

    /**
     * @test
     */
    public function it_stores_the_homepage_setting()
    {
        $data = HomepageSetting::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('homepage-settings.store'), $data);

        $this->assertDatabaseHas('homepage_settings', $data);

        $homepageSetting = HomepageSetting::latest('id')->first();

        $response->assertRedirect(
            route('homepage-settings.edit', $homepageSetting)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_homepage_setting()
    {
        $homepageSetting = HomepageSetting::factory()->create();

        $response = $this->get(
            route('homepage-settings.show', $homepageSetting)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.homepage_settings.show')
            ->assertViewHas('homepageSetting');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_homepage_setting()
    {
        $homepageSetting = HomepageSetting::factory()->create();

        $response = $this->get(
            route('homepage-settings.edit', $homepageSetting)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.homepage_settings.edit')
            ->assertViewHas('homepageSetting');
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
            'youtube_link_2' => $this->faker->text,
            'youtube_link_3' => $this->faker->text,
        ];

        $response = $this->put(
            route('homepage-settings.update', $homepageSetting),
            $data
        );

        $data['id'] = $homepageSetting->id;

        $this->assertDatabaseHas('homepage_settings', $data);

        $response->assertRedirect(
            route('homepage-settings.edit', $homepageSetting)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_homepage_setting()
    {
        $homepageSetting = HomepageSetting::factory()->create();

        $response = $this->delete(
            route('homepage-settings.destroy', $homepageSetting)
        );

        $response->assertRedirect(route('homepage-settings.index'));

        $this->assertModelMissing($homepageSetting);
    }
}
