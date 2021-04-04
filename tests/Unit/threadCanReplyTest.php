<?php

namespace Tests\Unit;

use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class threadCanReplyTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_thread_can_reply()
    {
        $thread = Thread::factory()->create();
        $thread->addReply([
            'body' => 'foo_bar',
            'user_id' => 1,
        ]);
        $this->assertCount(1, $thread->replies);
    }
}
