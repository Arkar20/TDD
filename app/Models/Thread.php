<?php

namespace App\Models;

use App\Models\Reply;
use App\Models\Channel;
use App\Models\Activity;
use App\Models\RecordActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    use HasFactory, RecordActivity;

    protected $fillable = ['user_id', 'title', 'body', 'channel_id'];
    protected $with = ['author', 'channel'];

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
        // return '/threads/' . $this->channel->slug . '/' . $this->id;
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });
        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function replies()
    {
        return $this->hasMany(Reply::class)->withCount('favourites');
    }
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
