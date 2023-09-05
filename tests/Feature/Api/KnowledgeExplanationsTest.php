<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Knowledge;
use App\Models\Explanation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KnowledgeExplanationsTest extends TestCase
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
    public function it_gets_knowledge_explanations(): void
    {
        $knowledge = Knowledge::factory()->create();
        $explanations = Explanation::factory()
            ->count(2)
            ->create([
                'knowledge_id' => $knowledge->id,
            ]);

        $response = $this->getJson(
            route('api.knowledges.explanations.index', $knowledge)
        );

        $response->assertOk()->assertSee($explanations[0]->file);
    }

    /**
     * @test
     */
    public function it_stores_the_knowledge_explanations(): void
    {
        $knowledge = Knowledge::factory()->create();
        $data = Explanation::factory()
            ->make([
                'knowledge_id' => $knowledge->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.knowledges.explanations.store', $knowledge),
            $data
        );

        unset($data['knowledge_id']);

        $this->assertDatabaseHas('explanations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $explanation = Explanation::latest('id')->first();

        $this->assertEquals($knowledge->id, $explanation->knowledge_id);
    }
}
