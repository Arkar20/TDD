@extends('layouts.app')

@section('content')
<div class="threads-block  ">
            @foreach ($threads as $thread)
                @include('threads.section.threadblock')
            @endforeach
        </div>

        </div>
    </div>
        
{{-- 
    <div class="">
        {{$threads->links()}}
    </div> --}}

    <div class="sigin mb-10 ">
        @if (!auth()->check())   
               <p class="text-center">Please  <a class="text-blue-800" href="{{ route('login') }}">sign in </a>  to create thread</p>
                
            @else
                @include('threads.section.createForm')
            @endif
    </div>
   
@endsection
    
