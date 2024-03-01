<?php

namespace Tests\Feature\Category;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_can_update_category(): void
    {
        $category = Category::create([
            "name" => "Makan",
            "type" => "out",
            "status" => 1,
        ]);

        $params = [
            "name" => "Gaji",
            "type" => "in",
            "status" => 0,
        ];

        $response = $this->putJson('/api/categories/'.$category->id, $params);

        $response->assertStatus(200);

        $category->refresh();
        $this->assertEquals("Gaji", $category->name);
        $this->assertEquals("in", $category->type);
        $this->assertEquals(0, $category->status);
    }

    public function test_it_cannot_update_category_if_params_empty(): void
    {
        $category = Category::create([
            "name" => "Makan",
            "type" => "out",
            "status" => 1,
        ]);

        $params = [];

        $response = $this->putJson('/api/categories/'.$category->id, $params);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(["name", "type", "status"]);
    }
}
