<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Jurnal;
use App\Models\Knowledge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KnowledgeJurnalsTest extends TestCase
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
    public function it_gets_knowledge_jurnals(): void
    {
        $knowledge = Knowledge::factory()->create();
        $jurnals = Jurnal::factory()
            ->count(2)
            ->create([
                'knowledge_id' => $knowledge->id,
            ]);

        $response = $this->getJson(
            route('api.knowledges.jurnals.index', $knowledge)
        );

        $response->assertOk()->assertSee($jurnals[0]->file);
    }

    /**
     * @test
     */
    public function it_stores_the_knowledge_jurnals(): void
    {
        $knowledge = Knowledge::factory()->create();
        $data = Jurnal::factory()
            ->make([
                'knowledge_id' => $knowledge->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.knowledges.jurnals.store', $knowledge),
            $data
        );

        unset($data['knowledge_id']);

        $this->assertDatabaseHas('jurnals', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $jurnal = Jurnal::latest('id')->first();

        $this->assertEquals($knowledge->id, $jurnal->knowledge_id);
    }
}
