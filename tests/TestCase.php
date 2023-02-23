<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    //pseudo sign in
    protected function signIn($user = null) 
    {
        $user = $user ?: factory('App\User')->create(); //if user is not defined create one

        $this->actingAs($user);

        return $user;
    }
}
