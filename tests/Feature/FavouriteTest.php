<?php

namespace Tests\Feature;

use App\Models\Favourite;
use Tests\TestCase;
use App\Models\Reply;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavouriteTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     * @test
     * @return void
     */

    public function replies_can_be_set_as_favourtie()
    {
        $this->signIn();
        // create the reply
        $reply = create(Reply::class);
        //hit the end point of that reply to store in favourite database

        $this->post('/replies/' . $reply->id . '/favourites');
        // $this->post('/replies/' . $reply->id . '/favourites');

        $this->assertCount(1, $reply->favourites);
    }
    /** @test */
    public function auth_user_can_only_favourite_once()
    {
        $this->signIn();
        // create the reply
        $reply = create(Reply::class);
        //hit the end point of that reply to store in favourite database

        try {
            $reply->makeFavourite();
            $reply->makeFavourite();
        } catch (\Exception $e) {
            $this->fail('Cannot favourite a sigle reply more than twice');
        }
        //increameant the favourite collection
        $this->assertCount(1, $reply->favourites);
    }
}
