<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Topic;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicTest extends TestCase
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
    public function it_gets_topics_list(): void
    {
        $topics = Topic::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.topics.index'));

        $response->assertOk()->assertSee($topics[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_topic(): void
    {
        $data = Topic::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.topics.store'), $data);

        $this->assertDatabaseHas('topics', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_topic(): void
    {
        $topic = Topic::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('api.topics.update', $topic), $data);

        $data['id'] = $topic->id;

        $this->assertDatabaseHas('topics', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_topic(): void
    {
        $topic = Topic::factory()->create();

        $response = $this->deleteJson(route('api.topics.destroy', $topic));

        $this->assertModelMissing($topic);

        $response->assertNoContent();
    }
}
