<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function store(Reply $reply)
    {
        $reply->makeFavourite();

        return back();
    }
}
