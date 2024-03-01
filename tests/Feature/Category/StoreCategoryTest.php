<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_can_store_new_category(): void
    {
        $params = [
            "name" => "Makan",
            "type" => "out",
            "status" => 1,
        ];
        $response = $this->postJson('/api/categories', $params);

        $response->assertStatus(200);

        $category = Category::findOrFail($response["data"]["id"]);
        $this->assertNotNull($category);

        $this->assertEquals("Makan", $category->name);
        $this->assertEquals("out", $category->type);
        $this->assertEquals(1, $category->status);
    }

    public function test_it_cannot_store_new_category_if_params_empty(): void
    {
        $params = [];
        $response = $this->postJson('/api/categories', $params);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(["name", "type", "status"]);
    }
}
