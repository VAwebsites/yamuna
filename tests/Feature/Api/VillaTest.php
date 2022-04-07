<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Villa;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VillaTest extends TestCase
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
    public function it_gets_villas_list()
    {
        $villas = Villa::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.villas.index'));

        $response->assertOk()->assertSee($villas[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_villa()
    {
        $data = Villa::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.villas.store'), $data);

        $this->assertDatabaseHas('villas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_villa()
    {
        $villa = Villa::factory()->create();

        $data = [
            'description' => $this->faker->text,
            'bhk' => $this->faker->randomNumber(0),
            'sq_feet' => $this->faker->randomNumber(2),
            'land_size' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'thumbnail' => $this->faker->text,
        ];

        $response = $this->putJson(route('api.villas.update', $villa), $data);

        $data['id'] = $villa->id;

        $this->assertDatabaseHas('villas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_villa()
    {
        $villa = Villa::factory()->create();

        $response = $this->deleteJson(route('api.villas.destroy', $villa));

        $this->assertModelMissing($villa);

        $response->assertNoContent();
    }
}
