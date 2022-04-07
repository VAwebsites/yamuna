<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BrochureRequest;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrochureRequestControllerTest extends TestCase
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
    public function it_displays_index_view_with_brochure_requests()
    {
        $brochureRequests = BrochureRequest::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('brochure-requests.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.brochure_requests.index')
            ->assertViewHas('brochureRequests');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_brochure_request()
    {
        $response = $this->get(route('brochure-requests.create'));

        $response->assertOk()->assertViewIs('app.brochure_requests.create');
    }

    /**
     * @test
     */
    public function it_stores_the_brochure_request()
    {
        $data = BrochureRequest::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('brochure-requests.store'), $data);

        $this->assertDatabaseHas('brochure_requests', $data);

        $brochureRequest = BrochureRequest::latest('id')->first();

        $response->assertRedirect(
            route('brochure-requests.edit', $brochureRequest)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_brochure_request()
    {
        $brochureRequest = BrochureRequest::factory()->create();

        $response = $this->get(
            route('brochure-requests.show', $brochureRequest)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.brochure_requests.show')
            ->assertViewHas('brochureRequest');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_brochure_request()
    {
        $brochureRequest = BrochureRequest::factory()->create();

        $response = $this->get(
            route('brochure-requests.edit', $brochureRequest)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.brochure_requests.edit')
            ->assertViewHas('brochureRequest');
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

        $response = $this->put(
            route('brochure-requests.update', $brochureRequest),
            $data
        );

        $data['id'] = $brochureRequest->id;

        $this->assertDatabaseHas('brochure_requests', $data);

        $response->assertRedirect(
            route('brochure-requests.edit', $brochureRequest)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_brochure_request()
    {
        $brochureRequest = BrochureRequest::factory()->create();

        $response = $this->delete(
            route('brochure-requests.destroy', $brochureRequest)
        );

        $response->assertRedirect(route('brochure-requests.index'));

        $this->assertModelMissing($brochureRequest);
    }
}
