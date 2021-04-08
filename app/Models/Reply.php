<?php

namespace App\Models;

use App\Models\Favourite;
use App\Models\RecordActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory, RecordActivity;

    protected $fillable = ['body', 'user_id', 'thread_id'];
    protected $with = ['owner', 'favourites', 'thread'];
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favourited');
    }
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
    public function makeFavourite()
    {
        if (
            !$this->favourites()
                ->where('user_id', auth()->id())
                ->exists()
        ) {
            $this->favourites()->create(['user_id' => auth()->id()]);
        }
    }
    public function isFavourited()
    {
        return !!$this->favourites->where('user_id', auth()->id())->count();
    }
    public function getFavouritesCountAttribute()
    {
        return $this->favourites->count();
    }
}
