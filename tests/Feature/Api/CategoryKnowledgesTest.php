<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Category;
use App\Models\Knowledge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryKnowledgesTest extends TestCase
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
    public function it_gets_category_knowledges(): void
    {
        $category = Category::factory()->create();
        $knowledges = Knowledge::factory()
            ->count(2)
            ->create([
                'category_id' => $category->id,
            ]);

        $response = $this->getJson(
            route('api.categories.knowledges.index', $category)
        );

        $response->assertOk()->assertSee($knowledges[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_category_knowledges(): void
    {
        $category = Category::factory()->create();
        $data = Knowledge::factory()
            ->make([
                'category_id' => $category->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.categories.knowledges.store', $category),
            $data
        );

        $this->assertDatabaseHas('knowledges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $knowledge = Knowledge::latest('id')->first();

        $this->assertEquals($category->id, $knowledge->category_id);
    }
}
