<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\NearByLocation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NearByLocationControllerTest extends TestCase
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
    public function it_displays_index_view_with_near_by_locations()
    {
        $nearByLocations = NearByLocation::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('near-by-locations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.near_by_locations.index')
            ->assertViewHas('nearByLocations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_near_by_location()
    {
        $response = $this->get(route('near-by-locations.create'));

        $response->assertOk()->assertViewIs('app.near_by_locations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_near_by_location()
    {
        $data = NearByLocation::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('near-by-locations.store'), $data);

        $this->assertDatabaseHas('near_by_locations', $data);

        $nearByLocation = NearByLocation::latest('id')->first();

        $response->assertRedirect(
            route('near-by-locations.edit', $nearByLocation)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_near_by_location()
    {
        $nearByLocation = NearByLocation::factory()->create();

        $response = $this->get(
            route('near-by-locations.show', $nearByLocation)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.near_by_locations.show')
            ->assertViewHas('nearByLocation');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_near_by_location()
    {
        $nearByLocation = NearByLocation::factory()->create();

        $response = $this->get(
            route('near-by-locations.edit', $nearByLocation)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.near_by_locations.edit')
            ->assertViewHas('nearByLocation');
    }

    /**
     * @test
     */
    public function it_updates_the_near_by_location()
    {
        $nearByLocation = NearByLocation::factory()->create();

        $data = [
            'img' => $this->faker->text,
            'name' => $this->faker->text,
            'order' => $this->faker->randomNumber(0),
        ];

        $response = $this->put(
            route('near-by-locations.update', $nearByLocation),
            $data
        );

        $data['id'] = $nearByLocation->id;

        $this->assertDatabaseHas('near_by_locations', $data);

        $response->assertRedirect(
            route('near-by-locations.edit', $nearByLocation)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_near_by_location()
    {
        $nearByLocation = NearByLocation::factory()->create();

        $response = $this->delete(
            route('near-by-locations.destroy', $nearByLocation)
        );

        $response->assertRedirect(route('near-by-locations.index'));

        $this->assertModelMissing($nearByLocation);
    }
}
