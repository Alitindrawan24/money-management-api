<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetCategoryTest extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function test_get_empty_categories(): void
    {
        $response = $this->getJson('/api/categories');

        $response->assertStatus(200);
        $this->assertEquals(5, count($response->json()["data"]));
    }

    public function test_get_categories_with_data(): void
    {
        Category::create([
            "name" => "Makan",
            "type" => "out",
            "status" => 1,
        ]);
        $response = $this->getJson('/api/categories');

        $response->assertStatus(200);
        $this->assertEquals(6, count($response->json()["data"]));
        $this->assertEquals("Makan", $response->json()["data"][0]["name"]);
        $this->assertEquals("Makan", $response->json()["data"][0]["name"]);
        $this->assertEquals("active", $response->json()["data"][0]["status"]);
    }
}
