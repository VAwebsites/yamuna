<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ApprovedBank;

use App\Models\HomepageSetting;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApprovedBankTest extends TestCase
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
    public function it_gets_approved_banks_list()
    {
        $approvedBanks = ApprovedBank::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.approved-banks.index'));

        $response->assertOk()->assertSee($approvedBanks[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_approved_bank()
    {
        $data = ApprovedBank::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.approved-banks.store'), $data);

        $this->assertDatabaseHas('approved_banks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_approved_bank()
    {
        $approvedBank = ApprovedBank::factory()->create();

        $homepageSetting = HomepageSetting::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'logo' => $this->faker->text,
            'order' => $this->faker->randomNumber(0),
            'homepage_setting_id' => $homepageSetting->id,
        ];

        $response = $this->putJson(
            route('api.approved-banks.update', $approvedBank),
            $data
        );

        $data['id'] = $approvedBank->id;

        $this->assertDatabaseHas('approved_banks', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_approved_bank()
    {
        $approvedBank = ApprovedBank::factory()->create();

        $response = $this->deleteJson(
            route('api.approved-banks.destroy', $approvedBank)
        );

        $this->assertModelMissing($approvedBank);

        $response->assertNoContent();
    }
}
