<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Villa;
use App\Models\VillaImage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VillaVillaImagesTest extends TestCase
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
    public function it_gets_villa_villa_images()
    {
        $villa = Villa::factory()->create();
        $villaImages = VillaImage::factory()
            ->count(2)
            ->create([
                'villa_id' => $villa->id,
            ]);

        $response = $this->getJson(
            route('api.villas.villa-images.index', $villa)
        );

        $response->assertOk()->assertSee($villaImages[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_villa_villa_images()
    {
        $villa = Villa::factory()->create();
        $data = VillaImage::factory()
            ->make([
                'villa_id' => $villa->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.villas.villa-images.store', $villa),
            $data
        );

        $this->assertDatabaseHas('villa_images', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $villaImage = VillaImage::latest('id')->first();

        $this->assertEquals($villa->id, $villaImage->villa_id);
    }
}
