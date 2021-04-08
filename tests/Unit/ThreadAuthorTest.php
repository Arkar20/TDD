<?php

namespace Tests\Unit;

use App\Models\Channel;
use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadAuthorTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    function setUp(): void
    {
        parent::setUp();
        $this->signIn();
    }
    public function test_thread_has_author()
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(User::class, $thread->author);
    }
    public function test_thread_has_channel_relationalShip()
    {
        $thread = create(Thread::class);
        $this->assertInstanceOf(
            Channel::class,
            $thread->channel,
            'Create the relationship with channel in the Thread Model'
        );
    }
}
