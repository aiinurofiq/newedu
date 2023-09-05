<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Exsum;
use App\Models\Knowledge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KnowledgeExsumsTest extends TestCase
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
    public function it_gets_knowledge_exsums(): void
    {
        $knowledge = Knowledge::factory()->create();
        $exsums = Exsum::factory()
            ->count(2)
            ->create([
                'knowledge_id' => $knowledge->id,
            ]);

        $response = $this->getJson(
            route('api.knowledges.exsums.index', $knowledge)
        );

        $response->assertOk()->assertSee($exsums[0]->file);
    }

    /**
     * @test
     */
    public function it_stores_the_knowledge_exsums(): void
    {
        $knowledge = Knowledge::factory()->create();
        $data = Exsum::factory()
            ->make([
                'knowledge_id' => $knowledge->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.knowledges.exsums.store', $knowledge),
            $data
        );

        unset($data['knowledge_id']);

        $this->assertDatabaseHas('exsums', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $exsum = Exsum::latest('id')->first();

        $this->assertEquals($knowledge->id, $exsum->knowledge_id);
    }
}
