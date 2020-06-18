<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp() : void
{
    parent::setUp();

    $this->withoutExceptionHandling();
}

    protected function signIn($user = null)
    {
        $user = $user ?: create('App\User');

        return $this->actingAs($user);
    }
}
