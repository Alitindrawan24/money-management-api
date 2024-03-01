<?php

namespace Tests\Feature\Category;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_can_delete_a_category(): void
    {
        $category = Category::create([
            "name" => "Makan",
            "type" => "out",
            "status" => 1,
        ]);
        $response = $this->deleteJson('/api/categories/'.$category->id);

        $response->assertStatus(200);
        $category = Category::find($category->id);
        $this->assertNull($category);
    }

    public function test_it_can_delete_category_but_not_all(): void
    {
        $category = Category::create([
            "name" => "Makan",
            "type" => "out",
            "status" => 1,
        ]);

        $this->assertEquals(6, Category::count());

        $response = $this->deleteJson('/api/categories/'.$category->id);

        $response->assertStatus(200);
        $category = Category::find($category->id);
        $this->assertNull($category);

        $this->assertEquals(5, Category::count());
    }

    public function test_it_cannot_delete_a_category_if_not_found(): void
    {
        $response = $this->deleteJson('/api/categories/99');

        $response->assertStatus(404);
    }
}
