<x-app-layout>
    @slot('header')
        <div>Thread single</div>
        
    @endslot
    <div class="mx-10 my-10"> 
                   @include('threads.section.threadblock')
    </div>

    <div class="reply">
         <div class="mx-10 my-10"> 
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
        @if (!auth()->check())
                       <p class="text-center">Please  <a class="text-blue-800" href="{{ route('login') }}">sign in </a>  to create thread</p>
        @else
                <div class="reply-form">
            @include('threads.section.replyForm')
        </div>
    @endif
   
   
</x-app-layout>