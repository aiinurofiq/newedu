<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Bumnclass;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BumnclassControllerTest extends TestCase
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
    public function it_displays_index_view_with_bumnclasses(): void
    {
        $bumnclasses = Bumnclass::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bumnclasses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bumnclasses.index')
            ->assertViewHas('bumnclasses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bumnclass(): void
    {
        $response = $this->get(route('bumnclasses.create'));

        $response->assertOk()->assertViewIs('app.bumnclasses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bumnclass(): void
    {
        $data = Bumnclass::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bumnclasses.store'), $data);

        $this->assertDatabaseHas('bumnclasses', $data);

        $bumnclass = Bumnclass::latest('id')->first();

        $response->assertRedirect(route('bumnclasses.edit', $bumnclass));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bumnclass(): void
    {
        $bumnclass = Bumnclass::factory()->create();

        $response = $this->get(route('bumnclasses.show', $bumnclass));

        $response
            ->assertOk()
            ->assertViewIs('app.bumnclasses.show')
            ->assertViewHas('bumnclass');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bumnclass(): void
    {
        $bumnclass = Bumnclass::factory()->create();

        $response = $this->get(route('bumnclasses.edit', $bumnclass));

        $response
            ->assertOk()
            ->assertViewIs('app.bumnclasses.edit')
            ->assertViewHas('bumnclass');
    }

    /**
     * @test
     */
    public function it_updates_the_bumnclass(): void
    {
        $bumnclass = Bumnclass::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->put(route('bumnclasses.update', $bumnclass), $data);

        $data['id'] = $bumnclass->id;

        $this->assertDatabaseHas('bumnclasses', $data);

        $response->assertRedirect(route('bumnclasses.edit', $bumnclass));
    }

    /**
     * @test
     */
    public function it_deletes_the_bumnclass(): void
    {
        $bumnclass = Bumnclass::factory()->create();

        $response = $this->delete(route('bumnclasses.destroy', $bumnclass));

        $response->assertRedirect(route('bumnclasses.index'));

        $this->assertModelMissing($bumnclass);
    }
}
