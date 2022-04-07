<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Image;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImageTest extends TestCase
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
    public function it_gets_images_list()
    {
        $images = Image::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.images.index'));

        $response->assertOk()->assertSee($images[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_image()
    {
        $data = Image::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.images.store'), $data);

        $this->assertDatabaseHas('images', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_image()
    {
        $image = Image::factory()->create();

        $data = [
            'img_path' => $this->faker->text,
            'order' => $this->faker->randomNumber(0),
        ];

        $response = $this->putJson(route('api.images.update', $image), $data);

        $data['id'] = $image->id;

        $this->assertDatabaseHas('images', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_image()
    {
        $image = Image::factory()->create();

        $response = $this->deleteJson(route('api.images.destroy', $image));

        $this->assertModelMissing($image);

        $response->assertNoContent();
    }
}
