<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\HomepageBanner;

use App\Models\HomepageSetting;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomepageBannerControllerTest extends TestCase
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
    public function it_displays_index_view_with_homepage_banners()
    {
        $homepageBanners = HomepageBanner::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('homepage-banners.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.homepage_banners.index')
            ->assertViewHas('homepageBanners');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_homepage_banner()
    {
        $response = $this->get(route('homepage-banners.create'));

        $response->assertOk()->assertViewIs('app.homepage_banners.create');
    }

    /**
     * @test
     */
    public function it_stores_the_homepage_banner()
    {
        $data = HomepageBanner::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('homepage-banners.store'), $data);

        $this->assertDatabaseHas('homepage_banners', $data);

        $homepageBanner = HomepageBanner::latest('id')->first();

        $response->assertRedirect(
            route('homepage-banners.edit', $homepageBanner)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_homepage_banner()
    {
        $homepageBanner = HomepageBanner::factory()->create();

        $response = $this->get(route('homepage-banners.show', $homepageBanner));

        $response
            ->assertOk()
            ->assertViewIs('app.homepage_banners.show')
            ->assertViewHas('homepageBanner');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_homepage_banner()
    {
        $homepageBanner = HomepageBanner::factory()->create();

        $response = $this->get(route('homepage-banners.edit', $homepageBanner));

        $response
            ->assertOk()
            ->assertViewIs('app.homepage_banners.edit')
            ->assertViewHas('homepageBanner');
    }

    /**
     * @test
     */
    public function it_updates_the_homepage_banner()
    {
        $homepageBanner = HomepageBanner::factory()->create();

        $homepageSetting = HomepageSetting::factory()->create();

        $data = [
            'banner' => $this->faker->text,
            'homepage_setting_id' => $homepageSetting->id,
        ];

        $response = $this->put(
            route('homepage-banners.update', $homepageBanner),
            $data
        );

        $data['id'] = $homepageBanner->id;

        $this->assertDatabaseHas('homepage_banners', $data);

        $response->assertRedirect(
            route('homepage-banners.edit', $homepageBanner)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_homepage_banner()
    {
        $homepageBanner = HomepageBanner::factory()->create();

        $response = $this->delete(
            route('homepage-banners.destroy', $homepageBanner)
        );

        $response->assertRedirect(route('homepage-banners.index'));

        $this->assertModelMissing($homepageBanner);
    }
}
