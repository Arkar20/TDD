<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('show');
    }
    public function show(User $user)
    {
        $activities = Activity::feed($user);

        return view('profile.profile', compact('activities'));
    }
}
