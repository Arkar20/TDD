<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public $thread;
    public $user;
    function setUp(): void
    {
        parent::setUp();
        $this->thread = create(Thread::class);
        $this->user = create(User::class);
    }

    public function test_a_thread_has_channel_url()
    {
        $thread = create(Thread::class);
        // dd($thread);
        $this->assertEquals(
            '/threads/' . $thread->channel->slug . '/' . $thread->id,
            $thread->path()
        );
    }
    public function test_user_can_view_threads()
    {
        $this->get('/threads')->assertSee($this->thread->title);
    }
    public function test_user_can_view_single_thread()
    {
        $this->signIn();
        $this->get($this->thread->path())->assertSee($this->thread->body);
    }
    /** @test */
    public function thread_can_be_filtered_by_username()
    {
        // $this->signIn(User::class, ['name' => 'Foo']);
        $user = create(User::class, ['name' => 'Foo']);
        $this->be($user);
        // create the thread by the user id
        $thread = create(Thread::class, ['user_id' => auth()->id()]);
        //create the another thread
        $threadNotByFoo = create(Thread::class);
        // go to the url by the name
        $this->get('/threads?by=' . auth()->user()->name)
            ->assertSee($thread->title)
            ->assertDontSee($threadNotByFoo);
        // see the thread of the user
        // dont see the other thread
    }
    /** @test */
    public function threads_can_be_filtered_by_popular()
    {
        //sigin

        $threadFor2Replies = create(Thread::class);
        $threadWith2Replies = Reply::factory()
            ->count(2)
            ->create(['thread_id' => $threadFor2Replies->id]);

        $threadFor3Replies = create(Thread::class);
        $threadWith3Replies = Reply::factory()
            ->count(3)
            ->create(['thread_id' => $threadFor3Replies->id]);

        $threadWithNoReplies = $this->thread;
        //create 3 threads with 3 replies, 2 replies, 0 replies
        $responese = $this->getJson('/threads?popular=1')->json();
        //go the the url and see
        $this->assertEquals(
            [3, 2, 0],
            array_column($responese, 'replies_count')
        );
    }
    /** @test */
    public function authorized_user_can_delete_a_thread()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $thread = create(Thread::class, ['user_id' => auth()->id()]);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);
        $this->json('DELETE', $thread->path())->assertStatus(204);
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
    }
    /** @test */
    public function unauthorized_user_cannot_delete_a_thread()
    {
        $this->signIn();
        $thread = create(Thread::class);
        $this->delete($thread->path())->assertStatus(403);
    }
}
