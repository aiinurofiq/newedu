<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Social;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSocialsTest extends TestCase
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
    public function it_gets_user_socials(): void
    {
        $user = User::factory()->create();
        $socials = Social::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.socials.index', $user));

        $response->assertOk()->assertSee($socials[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_socials(): void
    {
        $user = User::factory()->create();
        $data = Social::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.socials.store', $user),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('socials', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $social = Social::latest('id')->first();

        $this->assertEquals($user->id, $social->user_id);
    }
}
