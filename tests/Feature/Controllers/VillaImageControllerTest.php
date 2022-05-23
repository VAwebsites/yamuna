<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\VillaImage;

use App\Models\Villa;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VillaImageControllerTest extends TestCase
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
    public function it_displays_index_view_with_villa_images()
    {
        $villaImages = VillaImage::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('villa-images.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.villa_images.index')
            ->assertViewHas('villaImages');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_villa_image()
    {
        $response = $this->get(route('villa-images.create'));

        $response->assertOk()->assertViewIs('app.villa_images.create');
    }

    /**
     * @test
     */
    public function it_stores_the_villa_image()
    {
        $data = VillaImage::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('villa-images.store'), $data);

        $this->assertDatabaseHas('villa_images', $data);

        $villaImage = VillaImage::latest('id')->first();

        $response->assertRedirect(route('villa-images.edit', $villaImage));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_villa_image()
    {
        $villaImage = VillaImage::factory()->create();

        $response = $this->get(route('villa-images.show', $villaImage));

        $response
            ->assertOk()
            ->assertViewIs('app.villa_images.show')
            ->assertViewHas('villaImage');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_villa_image()
    {
        $villaImage = VillaImage::factory()->create();

        $response = $this->get(route('villa-images.edit', $villaImage));

        $response
            ->assertOk()
            ->assertViewIs('app.villa_images.edit')
            ->assertViewHas('villaImage');
    }

    /**
     * @test
     */
    public function it_updates_the_villa_image()
    {
        $villaImage = VillaImage::factory()->create();

        $villa = Villa::factory()->create();

        $data = [
            'image' => $this->faker->text,
            'villa_id' => $villa->id,
        ];

        $response = $this->put(
            route('villa-images.update', $villaImage),
            $data
        );

        $data['id'] = $villaImage->id;

        $this->assertDatabaseHas('villa_images', $data);

        $response->assertRedirect(route('villa-images.edit', $villaImage));
    }

    /**
     * @test
     */
    public function it_deletes_the_villa_image()
    {
        $villaImage = VillaImage::factory()->create();

        $response = $this->delete(route('villa-images.destroy', $villaImage));

        $response->assertRedirect(route('villa-images.index'));

        $this->assertModelMissing($villaImage);
    }
}
