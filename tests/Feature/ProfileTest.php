<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function auth_user_can_view_profile()
    {
        // sigin
        $user = create(User::class);
        $this->be($user);
        $this->get('/profile/' . auth()->user()->name)->assertSee($user->name);
    }
    // /** @test */
    public function guest_cannot_view_profile()
    {
        $this->get('/profile/1')->assertRedirect('/login');
    }
}
