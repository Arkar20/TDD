<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *
     * A basic feature test example.
     * @test
     * @return void
     */
    public $thread;
    public $reply;

    function setUp(): void
    {
        parent::setUp();
        $this->signIn();
        $this->thread = create(Thread::class);
        $this->reply = create(Reply::class, ['thread_id' => $this->thread->id]);
    }
    public function user_can_view_comments()
    {
        $this->get($this->thread->path())->assertSee($this->reply->body);
    }
    /**  @test*/
    public function unauthenticated_user_cannot_reply()
    {
        $reply = make(Reply::class);
        Auth::logout();
        $this->post(
            $this->thread->path() . '/replies',
            $reply->toArray()
        )->assertRedirect('/login');
    }
    public function test_authenticated_user_can_reply_thread()
    {
        $reply = make(Reply::class);

        $this->post($this->thread->path() . '/replies', $reply->toArray());

        $this->get($this->thread->path())->assertSee($reply->body);
    }
}
