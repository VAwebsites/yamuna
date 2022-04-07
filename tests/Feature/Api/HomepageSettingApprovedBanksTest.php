<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ApprovedBank;
use App\Models\HomepageSetting;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomepageSettingApprovedBanksTest extends TestCase
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
    public function it_gets_homepage_setting_approved_banks()
    {
        $homepageSetting = HomepageSetting::factory()->create();
        $approvedBanks = ApprovedBank::factory()
            ->count(2)
            ->create([
                'homepage_setting_id' => $homepageSetting->id,
            ]);

        $response = $this->getJson(
            route(
                'api.homepage-settings.approved-banks.index',
                $homepageSetting
            )
        );

        $response->assertOk()->assertSee($approvedBanks[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_homepage_setting_approved_banks()
    {
        $homepageSetting = HomepageSetting::factory()->create();
        $data = ApprovedBank::factory()
            ->make([
                'homepage_setting_id' => $homepageSetting->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.homepage-settings.approved-banks.store',
                $homepageSetting
            ),
            $data
        );

        unset($data['homepage_setting_id']);

        $this->assertDatabaseHas('approved_banks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $approvedBank = ApprovedBank::latest('id')->first();

        $this->assertEquals(
            $homepageSetting->id,
            $approvedBank->homepage_setting_id
        );
    }
}
