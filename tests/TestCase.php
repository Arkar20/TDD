<?php

namespace Tests;

use App\Models\User;
use App\Exceptions\Handler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;
// use Illuminate\Contracts\Auth\Authenticatable;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn($user = null)
    {
        $user = $user ?: create(User::class);
        $this->be($user);
        return $this;
    }
}
