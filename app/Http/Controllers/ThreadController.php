<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Filters\ThreadFilter;
use Illuminate\Support\Facades\DB;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'show', 'destroy']);
    }
    public function index(Channel $channel = null, ThreadFilter $filters)
    {
        if ($channel) {
            $threads = $channel->threads()->latest();
        } else {
            $threads = Thread::latest();
        }

        $threads = $threads->filter($filters)->paginate(10);

        if (request()->wantsJson()) {
            return $threads;
        }

        // $threads = DB::getQueryLog();
        // dd($threads);

        // if ($username = request('by')) {
        //     $user = User::where('name', $username)->firstOrFail();
        //     $threads->where('user_id', $user->id);
        // }
        // $threads = $threads->paginate(10);

        // $threads = Thread::filter($filters)->get();
        // return $threads;
        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'title' => 'required',
            'channel_id' => 'required|exists:channels,id',
            'body' => 'required',
        ]);
        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body'),
        ]);

        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channel, Thread $thread)
    {
        return view('threads.single', [
            'thread' => $thread->load('replies.owner'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }
        return redirect('/threads');
    }
}
