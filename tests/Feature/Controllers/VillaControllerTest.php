<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Villa;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VillaControllerTest extends TestCase
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
    public function it_displays_index_view_with_villas()
    {
        $villas = Villa::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('villas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.villas.index')
            ->assertViewHas('villas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_villa()
    {
        $response = $this->get(route('villas.create'));

        $response->assertOk()->assertViewIs('app.villas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_villa()
    {
        $data = Villa::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('villas.store'), $data);

        $this->assertDatabaseHas('villas', $data);

        $villa = Villa::latest('id')->first();

        $response->assertRedirect(route('villas.edit', $villa));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_villa()
    {
        $villa = Villa::factory()->create();

        $response = $this->get(route('villas.show', $villa));

        $response
            ->assertOk()
            ->assertViewIs('app.villas.show')
            ->assertViewHas('villa');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_villa()
    {
        $villa = Villa::factory()->create();

        $response = $this->get(route('villas.edit', $villa));

        $response
            ->assertOk()
            ->assertViewIs('app.villas.edit')
            ->assertViewHas('villa');
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

        $response = $this->put(route('villas.update', $villa), $data);

        $data['id'] = $villa->id;

        $this->assertDatabaseHas('villas', $data);

        $response->assertRedirect(route('villas.edit', $villa));
    }

    /**
     * @test
     */
    public function it_deletes_the_villa()
    {
        $villa = Villa::factory()->create();

        $response = $this->delete(route('villas.destroy', $villa));

        $response->assertRedirect(route('villas.index'));

        $this->assertModelMissing($villa);
    }
}
