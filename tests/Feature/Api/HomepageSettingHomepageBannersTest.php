<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\HomepageBanner;
use App\Models\HomepageSetting;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomepageSettingHomepageBannersTest extends TestCase
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
    public function it_gets_homepage_setting_homepage_banners()
    {
        $homepageSetting = HomepageSetting::factory()->create();
        $homepageBanners = HomepageBanner::factory()
            ->count(2)
            ->create([
                'homepage_setting_id' => $homepageSetting->id,
            ]);

        $response = $this->getJson(
            route(
                'api.homepage-settings.homepage-banners.index',
                $homepageSetting
            )
        );

        $response->assertOk()->assertSee($homepageBanners[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_homepage_setting_homepage_banners()
    {
        $homepageSetting = HomepageSetting::factory()->create();
        $data = HomepageBanner::factory()
            ->make([
                'homepage_setting_id' => $homepageSetting->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.homepage-settings.homepage-banners.store',
                $homepageSetting
            ),
            $data
        );

        $this->assertDatabaseHas('homepage_banners', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $homepageBanner = HomepageBanner::latest('id')->first();

        $this->assertEquals(
            $homepageSetting->id,
            $homepageBanner->homepage_setting_id
        );
    }
}
