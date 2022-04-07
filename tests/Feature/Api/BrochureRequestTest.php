<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BrochureRequest;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrochureRequestTest extends TestCase
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
    public function it_gets_brochure_requests_list()
    {
        $brochureRequests = BrochureRequest::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.brochure-requests.index'));

        $response->assertOk()->assertSee($brochureRequests[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_brochure_request()
    {
        $data = BrochureRequest::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.brochure-requests.store'),
            $data
        );

        $this->assertDatabaseHas('brochure_requests', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_brochure_request()
    {
        $brochureRequest = BrochureRequest::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
            'email' => $this->faker->email,
            'phone' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.brochure-requests.update', $brochureRequest),
            $data
        );

        $data['id'] = $brochureRequest->id;

        $this->assertDatabaseHas('brochure_requests', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_brochure_request()
    {
        $brochureRequest = BrochureRequest::factory()->create();

        $response = $this->deleteJson(
            route('api.brochure-requests.destroy', $brochureRequest)
        );

        $this->assertModelMissing($brochureRequest);

        $response->assertNoContent();
    }
}
