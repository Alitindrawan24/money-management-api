<?php

namespace Tests\Feature\Category;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowCategoryTest extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function test_it_can_show_a_category(): void
    {
        $category = Category::create([
            "name" => "Makan",
            "type" => "out",
            "status" => 1,
        ]);
        $response = $this->getJson('/api/categories/'.$category->id);

        $response->assertStatus(200);

        $this->assertEquals("Makan", $response->json()["data"]["name"]);
        $this->assertEquals("out", $response->json()["data"]["type"]);
        $this->assertEquals("active", $response->json()["data"]["status"]);
    }

    public function test_it_cannot_show_a_category_if_not_found(): void
    {
        $response = $this->getJson('/api/categories/99');

        $response->assertStatus(404);
    }
}
