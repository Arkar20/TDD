<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

class ThreadFilter extends Filters
{
    protected $filters = ['by', 'popular'];
    public function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builders->where('user_id', $user->id);
    }
    protected function popular()
    {
        $this->builders->getQuery()->orders = [];
        return $this->builders->orderBy('replies_count', 'desc');
    }
}
