<?php

namespace Tests\Unit;

use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function a_channel_has_many_threads()
    {
        // create a channel
        $this->signIn();
        $channel = create(Channel::class);
        // dd($channel);
        // create the thread based on that channal
        $thread = create(Thread::class, ['channel_id' => $channel->id]);
        // dd($thread);
        //see the threads are within the channel collation
        $this->assertTrue($channel->threads->contains($thread));
    }
}
