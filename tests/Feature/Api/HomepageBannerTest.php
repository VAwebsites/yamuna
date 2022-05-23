<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\HomepageBanner;

use App\Models\HomepageSetting;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomepageBannerTest extends TestCase
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
    public function it_gets_homepage_banners_list()
    {
        $homepageBanners = HomepageBanner::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.homepage-banners.index'));

        $response->assertOk()->assertSee($homepageBanners[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_homepage_banner()
    {
        $data = HomepageBanner::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.homepage-banners.store'), $data);

        $this->assertDatabaseHas('homepage_banners', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.homepage-banners.update', $homepageBanner),
            $data
        );

        $data['id'] = $homepageBanner->id;

        $this->assertDatabaseHas('homepage_banners', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_homepage_banner()
    {
        $homepageBanner = HomepageBanner::factory()->create();

        $response = $this->deleteJson(
            route('api.homepage-banners.destroy', $homepageBanner)
        );

        $this->assertModelMissing($homepageBanner);

        $response->assertNoContent();
    }
}
