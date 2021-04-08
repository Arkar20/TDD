<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;

use App\Models\Channel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;

class CreateTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public $thread;
    public $user;

    public function test_guest_cannot_create_thread()
    {
        $this->signIn();
        // $this->withoutExceptionHandling();
        $thread = create(Thread::class);

        Auth::logout();
        $this->post('/threads', $thread->toArray())->assertRedirect('/login');
    }
    public function test_auth_user_can_create_thread()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $thread = Thread::factory()->make();

        $response = $this->post('/threads', $thread->toArray());

        // dd($response->headers->get('Location'));

        $this->get($response->headers->get('Location'))->assertSee(
            $thread->body
        );
    }
    /** @test */
    public function a_thread_requires_a_titles()
    {
        $this->publishThread(['title' => ''])->assertSessionHasErrors('title');
    }
    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => ''])->assertSessionHasErrors('body');
    }
    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $channel = create(Channel::class);
        $thread = Thread::factory()->make([
            'channel_id' => '',
        ]);
        $thread2 = Thread::factory()->make([
            'channel_id' => 999,
        ]);

        $response = $this->post(
            '/threads',
            $thread->toArray()
        )->assertSessionHasErrors(['channel_id']);
        $response = $this->post(
            '/threads',
            $thread2->toArray()
        )->assertSessionHasErrors(['channel_id']);
    }
    /** @test */

    function publishThread($overwirtes = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = make(Thread::class, $overwirtes);
        // dd($thread);
        return $this->post('/threads', $thread->toArray());
    }
    /** @test */
    public function thread_can_filter_threads_by_channel_slug()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $channel = create(Channel::class);

        $threadToSee = create(Thread::class, ['channel_id' => $channel->id]);
        $threadNotToSee = create(Thread::class);
        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadToSee->title)
            ->assertDontSee($threadNotToSee->title);
    }
}
