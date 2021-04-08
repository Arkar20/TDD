<?php

namespace Tests\Feature;

use Reflection;
use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Activity;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function record_the_activity_when_thread_is_created()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->assertDatabaseHas('activities', [
            'type' =>
                'created_' . (new \ReflectionClass($thread))->getShortName(),
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => get_class($thread),
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $thread->id);
    }
    /** @test */
    public function it_records_activity_when_reply()
    {
        $this->signIn();
        $reply = create(Reply::class);

        // dd($reply);
        $this->assertCount(2, Activity::all());
    }
    /** @test */
    // public function it_fetch_Activity_for_any_user()
    // {
    //     $this->signIn();
    //     //create the thread
    //     $thread = create(Thread::class);
    //     //create another thread a week ago
    //     $threadFromAnotherweek = create(Thread::class, [
    //         'created_at' => Carbon::now()->subweek(),
    //     ]);
    //     //feed the activity and see the activites are sorted by the date;
    //     $threadFromAnotherweek
    //         ->activity()
    //         ->update(['created_at' => Carbon::now()->subweek()]);
    //     $activity = Activity::feed(auth()->user());

    //     $this->assertTrue(
    //         $activity->keys()->contains(Carbon::now()->format('M-d-Y'))
    //     );
    //     $this->assertTrue(
    //         $activity->keys()->contains(
    //             Carbon::now()
    //                 ->subWeek()
    //                 ->format('M-d-Y')
    //         )
    //     );
    // }
}
