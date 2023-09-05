<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Knowledge;

use App\Models\Topic;
use App\Models\Category;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KnowledgeControllerTest extends TestCase
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
    public function it_displays_index_view_with_knowledges(): void
    {
        $knowledges = Knowledge::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('knowledges.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.knowledges.index')
            ->assertViewHas('knowledges');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_knowledge(): void
    {
        $response = $this->get(route('knowledges.create'));

        $response->assertOk()->assertViewIs('app.knowledges.create');
    }

    /**
     * @test
     */
    public function it_stores_the_knowledge(): void
    {
        $data = Knowledge::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('knowledges.store'), $data);

        $this->assertDatabaseHas('knowledges', $data);

        $knowledge = Knowledge::latest('id')->first();

        $response->assertRedirect(route('knowledges.edit', $knowledge));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_knowledge(): void
    {
        $knowledge = Knowledge::factory()->create();

        $response = $this->get(route('knowledges.show', $knowledge));

        $response
            ->assertOk()
            ->assertViewIs('app.knowledges.show')
            ->assertViewHas('knowledge');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_knowledge(): void
    {
        $knowledge = Knowledge::factory()->create();

        $response = $this->get(route('knowledges.edit', $knowledge));

        $response
            ->assertOk()
            ->assertViewIs('app.knowledges.edit')
            ->assertViewHas('knowledge');
    }

    /**
     * @test
     */
    public function it_updates_the_knowledge(): void
    {
        $knowledge = Knowledge::factory()->create();

        $user = User::factory()->create();
        $topic = Topic::factory()->create();
        $category = Category::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'writer' => $this->faker->text(255),
            'abstract' => $this->faker->text(255),
            'status' => $this->faker->boolean(),
            'user_id' => $user->id,
            'topic_id' => $topic->id,
            'category_id' => $category->id,
        ];

        $response = $this->put(route('knowledges.update', $knowledge), $data);

        $data['id'] = $knowledge->id;

        $this->assertDatabaseHas('knowledges', $data);

        $response->assertRedirect(route('knowledges.edit', $knowledge));
    }

    /**
     * @test
     */
    public function it_deletes_the_knowledge(): void
    {
        $knowledge = Knowledge::factory()->create();

        $response = $this->delete(route('knowledges.destroy', $knowledge));

        $response->assertRedirect(route('knowledges.index'));

        $this->assertModelMissing($knowledge);
    }
}
