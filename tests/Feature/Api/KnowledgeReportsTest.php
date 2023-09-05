<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Report;
use App\Models\Knowledge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KnowledgeReportsTest extends TestCase
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
    public function it_gets_knowledge_reports(): void
    {
        $knowledge = Knowledge::factory()->create();
        $reports = Report::factory()
            ->count(2)
            ->create([
                'knowledge_id' => $knowledge->id,
            ]);

        $response = $this->getJson(
            route('api.knowledges.reports.index', $knowledge)
        );

        $response->assertOk()->assertSee($reports[0]->file);
    }

    /**
     * @test
     */
    public function it_stores_the_knowledge_reports(): void
    {
        $knowledge = Knowledge::factory()->create();
        $data = Report::factory()
            ->make([
                'knowledge_id' => $knowledge->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.knowledges.reports.store', $knowledge),
            $data
        );

        unset($data['knowledge_id']);

        $this->assertDatabaseHas('reports', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $report = Report::latest('id')->first();

        $this->assertEquals($knowledge->id, $report->knowledge_id);
    }
}
