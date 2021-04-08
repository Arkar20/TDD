<x-app-layout>
    @slot('header')
        <div class="text-2xl font-semibold tracking-wide uppercase flex justify-between">
            <p>A thread created by 
                <span class="text-blue-400">
                    {{$thread->author->name}}
                </span>
            </p>
            @can('update', $thread)
            <form action="{{$thread->path()}}" method="POST">
                @csrf
                @method('DELETE')
                <x-button type="submit" class="bg-red-500">
                        Delete
                </x-button>
            </form>    
            @endcan
            
        </div>
        
    @endslot
        <div class="flex justify-center">

                    <div class="mx-10 my-10 w-3/4"> 
                                @include('threads.section.threadblock')
                                <div class="reply">
                                    <div class=" my-10 "> 
                                        <h3 class="py-4 uppercase tracking-wider">REplies ({{$thread->replies_count}})</h3>
                                        @forelse ($thread->replies as $reply)
                                                @include('threads.section.replysection')
                                        @empty
                                        <div class="body mx-auto text-gray-500 px-3 py-6">
                                            <p>No Replies</p>
                                        </div>
                                        @endforelse
                                    
                                    </div>
                                </div>
                    </div>
                    
                    <div class="mx-10 my-10"> 
                               <div class="bg-white rounded-md shadow  mb-4 px-4 py-6">
                                This thread was created at {{$thread->created_at->diffForHumans()}} 
                                by
                                <span class="italic text-blue-400"> {{$thread->author->name}}</span> 
                                and has <span class="italic text-blue-400">  {{$thread->replies_count}} {{Str::plural('reply',$thread->replies_count)}}.</span> 
                    </div>
        </div>
        </div>

    
        @if (!auth()->check())
                       <p class="text-center">Please  <a class="text-blue-800" href="{{ route('login') }}">sign in </a>  to create thread</p>
        @else
                <div class="reply-form">
            @include('threads.section.replyForm')
        </div>
    @endif
   
   
</x-app-layout>