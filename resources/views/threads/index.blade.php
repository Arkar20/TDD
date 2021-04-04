<x-app-layout>
    @slot('header')
        <div>Threads</div>
        
    @endslot

<div   class="threads-block mx-10 my-10">
            @foreach ($threads as $thread)
                @include('threads.section.threadblock')
            @endforeach
        </div>

        </div>
    </div>
        
{{-- 
    <div class=" pb-10 border-b border-gray-400 mx-10">
        {{$threads->links()}}
    </div> --}}

    <div class="sigin mb-10 ">
        @if (!auth()->check())   
               <p class="text-center">Please  <a class="text-blue-800" href="{{ route('login') }}">sign in </a>  to create thread</p>
                
            @else
                @include('threads.section.createForm')
            @endif
    </div>
   
</x-app-layout>