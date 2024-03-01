<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    protected function login()
    {
        $user = User::where("name", "test")->first();
        $this->actingAs($user);
    }
}
