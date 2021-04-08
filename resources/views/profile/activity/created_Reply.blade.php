 
@component('profile.activity.activity')

    @slot('header')
    <a  class="px-4 py-2 text-md flex justify-between" href="{{$activity->subject->owner}}">
                        <p class="inline-block text-lg text-blue-700 uppercase tracking-wide">
                        {{$activity->subject->owner->name}} commented on <span class="inline-block text-lg">"{{$activity->subject->thread->title}}"</span>
                    <span class="text-xs text-gray-400 italic">
                                {{$activity->created_at->diffForHumans()}}
                        </span>
                        </p> 
        
    @endslot
    @slot('body')
                                <p>{{$activity->subject->body}}</p>

    @endslot
@endcomponent