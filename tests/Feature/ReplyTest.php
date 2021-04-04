<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *
     * A basic feature test example.
     * @test
     * @return void
     */
    public function user_can_view_comments()
    {
        //thread has comments
        $this->signIn();

        // $this->withoutExceptionHandling();
        $thread = create(Thread::class);
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $this->get($thread->path())->assertSee($reply->body);
    }
    /**  @test*/
    public function unauthenticated_user_cannot_reply()
    {
        $thread = create(Thread::class);
        $reply = create(Reply::class);

        $this->post(
            $thread->path() . '/replies',
            $reply->toArray()
        )->assertRedirect('/login');
    }
    public function test_authenticated_user_can_reply_thread()
    {
        // authenticate the user
        // $this->withExceptionHandling();

        $thread = create(Thread::class);
        $this->signIn();

        $reply = Reply::factory()->make(['thread_id' => $thread->id]);
        $this->withoutExceptionHandling()->post(
            $thread->path() . '/replies',
            $reply->toArray()
        );
        $this->get($thread->path())->assertSee($reply->body);
    }
}
