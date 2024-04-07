<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Database\Factories\TransactionFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
        ]);

        for ($i=0; $i < 5; $i++) {
            $category = Category::factory()->create([
                "user_id" => $user->id
            ]);

            Transaction::factory(2)->create([
                "user_id" => $user->id,
                "category_id" => $category->id
            ]);
        }


    }
}
