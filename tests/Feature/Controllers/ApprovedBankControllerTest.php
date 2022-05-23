<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ApprovedBank;

use App\Models\HomepageSetting;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApprovedBankControllerTest extends TestCase
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
    public function it_displays_index_view_with_approved_banks()
    {
        $approvedBanks = ApprovedBank::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('approved-banks.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.approved_banks.index')
            ->assertViewHas('approvedBanks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_approved_bank()
    {
        $response = $this->get(route('approved-banks.create'));

        $response->assertOk()->assertViewIs('app.approved_banks.create');
    }

    /**
     * @test
     */
    public function it_stores_the_approved_bank()
    {
        $data = ApprovedBank::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('approved-banks.store'), $data);

        $this->assertDatabaseHas('approved_banks', $data);

        $approvedBank = ApprovedBank::latest('id')->first();

        $response->assertRedirect(route('approved-banks.edit', $approvedBank));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_approved_bank()
    {
        $approvedBank = ApprovedBank::factory()->create();

        $response = $this->get(route('approved-banks.show', $approvedBank));

        $response
            ->assertOk()
            ->assertViewIs('app.approved_banks.show')
            ->assertViewHas('approvedBank');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_approved_bank()
    {
        $approvedBank = ApprovedBank::factory()->create();

        $response = $this->get(route('approved-banks.edit', $approvedBank));

        $response
            ->assertOk()
            ->assertViewIs('app.approved_banks.edit')
            ->assertViewHas('approvedBank');
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

        $response = $this->put(
            route('approved-banks.update', $approvedBank),
            $data
        );

        $data['id'] = $approvedBank->id;

        $this->assertDatabaseHas('approved_banks', $data);

        $response->assertRedirect(route('approved-banks.edit', $approvedBank));
    }

    /**
     * @test
     */
    public function it_deletes_the_approved_bank()
    {
        $approvedBank = ApprovedBank::factory()->create();

        $response = $this->delete(
            route('approved-banks.destroy', $approvedBank)
        );

        $response->assertRedirect(route('approved-banks.index'));

        $this->assertModelMissing($approvedBank);
    }
}
