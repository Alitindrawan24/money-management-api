<?php

namespace Tests\Feature\Transaction;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_can_store_transactions(): void
    {
        $this->login();
        $params = Transaction::factory()->make()->toArray();
        unset($params["user_id"]);
        $params["tag_ids"] = [];

        $response = $this->postJson('/api/transactions', $params);

        $response->assertStatus(200);
    }
}
