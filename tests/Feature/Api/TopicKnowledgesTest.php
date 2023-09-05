<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Topic;
use App\Models\Knowledge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicKnowledgesTest extends TestCase
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
    public function it_gets_topic_knowledges(): void
    {
        $topic = Topic::factory()->create();
        $knowledges = Knowledge::factory()
            ->count(2)
            ->create([
                'topic_id' => $topic->id,
            ]);

        $response = $this->getJson(
            route('api.topics.knowledges.index', $topic)
        );

        $response->assertOk()->assertSee($knowledges[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_topic_knowledges(): void
    {
        $topic = Topic::factory()->create();
        $data = Knowledge::factory()
            ->make([
                'topic_id' => $topic->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.topics.knowledges.store', $topic),
            $data
        );

        $this->assertDatabaseHas('knowledges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $knowledge = Knowledge::latest('id')->first();

        $this->assertEquals($topic->id, $knowledge->topic_id);
    }
}
