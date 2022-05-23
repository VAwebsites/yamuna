<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\VillaImage;

use App\Models\Villa;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VillaImageTest extends TestCase
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
    public function it_gets_villa_images_list()
    {
        $villaImages = VillaImage::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.villa-images.index'));

        $response->assertOk()->assertSee($villaImages[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_villa_image()
    {
        $data = VillaImage::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.villa-images.store'), $data);

        $this->assertDatabaseHas('villa_images', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.villa-images.update', $villaImage),
            $data
        );

        $data['id'] = $villaImage->id;

        $this->assertDatabaseHas('villa_images', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_villa_image()
    {
        $villaImage = VillaImage::factory()->create();

        $response = $this->deleteJson(
            route('api.villa-images.destroy', $villaImage)
        );

        $this->assertModelMissing($villaImage);

        $response->assertNoContent();
    }
}
