<?php

namespace Tests\Feature\Transaction;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetTransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_can_get_all_transactions(): void
    {
        $this->login();
        $response = $this->getJson('/api/transactions');

        $response->assertStatus(200);

        $this->assertEquals(5, count($response->json()["data"]));
    }

    public function test_it_cannot_get_all_transactions_if_not_logged(): void
    {
        $response = $this->getJson('/api/transactions');

        $response->assertStatus(401);
    }
}
