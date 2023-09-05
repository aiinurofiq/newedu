<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Knowledge;

use App\Models\Topic;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KnowledgeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_knowledges_list(): void
    {
        $knowledges = Knowledge::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.knowledges.index'));

        $response->assertOk()->assertSee($knowledges[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_knowledge(): void
    {
        $data = Knowledge::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.knowledges.store'), $data);

        $this->assertDatabaseHas('knowledges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.knowledges.update', $knowledge),
            $data
        );

        $data['id'] = $knowledge->id;

        $this->assertDatabaseHas('knowledges', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_knowledge(): void
    {
        $knowledge = Knowledge::factory()->create();

        $response = $this->deleteJson(
            route('api.knowledges.destroy', $knowledge)
        );

        $this->assertModelMissing($knowledge);

        $response->assertNoContent();
    }
}
