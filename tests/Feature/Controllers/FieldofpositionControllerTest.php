<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Fieldofposition;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FieldofpositionControllerTest extends TestCase
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
    public function it_displays_index_view_with_fieldofpositions(): void
    {
        $fieldofpositions = Fieldofposition::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('fieldofpositions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.fieldofpositions.index')
            ->assertViewHas('fieldofpositions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_fieldofposition(): void
    {
        $response = $this->get(route('fieldofpositions.create'));

        $response->assertOk()->assertViewIs('app.fieldofpositions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_fieldofposition(): void
    {
        $data = Fieldofposition::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('fieldofpositions.store'), $data);

        $this->assertDatabaseHas('fieldofpositions', $data);

        $fieldofposition = Fieldofposition::latest('id')->first();

        $response->assertRedirect(
            route('fieldofpositions.edit', $fieldofposition)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_fieldofposition(): void
    {
        $fieldofposition = Fieldofposition::factory()->create();

        $response = $this->get(
            route('fieldofpositions.show', $fieldofposition)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.fieldofpositions.show')
            ->assertViewHas('fieldofposition');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_fieldofposition(): void
    {
        $fieldofposition = Fieldofposition::factory()->create();

        $response = $this->get(
            route('fieldofpositions.edit', $fieldofposition)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.fieldofpositions.edit')
            ->assertViewHas('fieldofposition');
    }

    /**
     * @test
     */
    public function it_updates_the_fieldofposition(): void
    {
        $fieldofposition = Fieldofposition::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->put(
            route('fieldofpositions.update', $fieldofposition),
            $data
        );

        $data['id'] = $fieldofposition->id;

        $this->assertDatabaseHas('fieldofpositions', $data);

        $response->assertRedirect(
            route('fieldofpositions.edit', $fieldofposition)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_fieldofposition(): void
    {
        $fieldofposition = Fieldofposition::factory()->create();

        $response = $this->delete(
            route('fieldofpositions.destroy', $fieldofposition)
        );

        $response->assertRedirect(route('fieldofpositions.index'));

        $this->assertModelMissing($fieldofposition);
    }
}
