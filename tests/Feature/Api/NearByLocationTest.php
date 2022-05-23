<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\NearByLocation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NearByLocationTest extends TestCase
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
    public function it_gets_near_by_locations_list()
    {
        $nearByLocations = NearByLocation::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.near-by-locations.index'));

        $response->assertOk()->assertSee($nearByLocations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_near_by_location()
    {
        $data = NearByLocation::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.near-by-locations.store'),
            $data
        );

        $this->assertDatabaseHas('near_by_locations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.near-by-locations.update', $nearByLocation),
            $data
        );

        $data['id'] = $nearByLocation->id;

        $this->assertDatabaseHas('near_by_locations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_near_by_location()
    {
        $nearByLocation = NearByLocation::factory()->create();

        $response = $this->deleteJson(
            route('api.near-by-locations.destroy', $nearByLocation)
        );

        $this->assertModelMissing($nearByLocation);

        $response->assertNoContent();
    }
}
