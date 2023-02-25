<?php

namespace Tests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, HasFactory;

    //pseudo sign in
    protected function signIn($user = null) 
    {
        //$this->withoutExceptionHandling(); 

        $user = $user ?: User::factory()->create(); //if user is not defined create one

        $this->actingAs($user);

        return $user;
    }
}
