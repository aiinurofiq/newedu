<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Bumnsector;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BumnsectorControllerTest extends TestCase
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
    public function it_displays_index_view_with_bumnsectors(): void
    {
        $bumnsectors = Bumnsector::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bumnsectors.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bumnsectors.index')
            ->assertViewHas('bumnsectors');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bumnsector(): void
    {
        $response = $this->get(route('bumnsectors.create'));

        $response->assertOk()->assertViewIs('app.bumnsectors.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bumnsector(): void
    {
        $data = Bumnsector::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bumnsectors.store'), $data);

        $this->assertDatabaseHas('bumnsectors', $data);

        $bumnsector = Bumnsector::latest('id')->first();

        $response->assertRedirect(route('bumnsectors.edit', $bumnsector));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bumnsector(): void
    {
        $bumnsector = Bumnsector::factory()->create();

        $response = $this->get(route('bumnsectors.show', $bumnsector));

        $response
            ->assertOk()
            ->assertViewIs('app.bumnsectors.show')
            ->assertViewHas('bumnsector');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bumnsector(): void
    {
        $bumnsector = Bumnsector::factory()->create();

        $response = $this->get(route('bumnsectors.edit', $bumnsector));

        $response
            ->assertOk()
            ->assertViewIs('app.bumnsectors.edit')
            ->assertViewHas('bumnsector');
    }

    /**
     * @test
     */
    public function it_updates_the_bumnsector(): void
    {
        $bumnsector = Bumnsector::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->put(route('bumnsectors.update', $bumnsector), $data);

        $data['id'] = $bumnsector->id;

        $this->assertDatabaseHas('bumnsectors', $data);

        $response->assertRedirect(route('bumnsectors.edit', $bumnsector));
    }

    /**
     * @test
     */
    public function it_deletes_the_bumnsector(): void
    {
        $bumnsector = Bumnsector::factory()->create();

        $response = $this->delete(route('bumnsectors.destroy', $bumnsector));

        $response->assertRedirect(route('bumnsectors.index'));

        $this->assertModelMissing($bumnsector);
    }
}
