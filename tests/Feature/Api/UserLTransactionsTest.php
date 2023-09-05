<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\LTransaction;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLTransactionsTest extends TestCase
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
    public function it_gets_user_l_transactions(): void
    {
        $user = User::factory()->create();
        $lTransactions = LTransaction::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.l-transactions.index', $user)
        );

        $response->assertOk()->assertSee($lTransactions[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_user_l_transactions(): void
    {
        $user = User::factory()->create();
        $data = LTransaction::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.l-transactions.store', $user),
            $data
        );

        unset($data['uuid']);
        unset($data['user_id']);
        unset($data['learning_id']);
        unset($data['lpayment_id']);
        unset($data['coupon_id']);
        unset($data['totalamount']);

        $this->assertDatabaseHas('l_transactions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $lTransaction = LTransaction::latest('id')->first();

        $this->assertEquals($user->id, $lTransaction->user_id);
    }
}
