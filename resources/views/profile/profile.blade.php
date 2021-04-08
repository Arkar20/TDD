<x-app-layout>
    @slot('header')
        <div>Profile Page</div>
        
    @endslot

<div   class="threads-block mx-10 my-10">
            @foreach ($activities as $date=>$record)
            <h3 class="mx-4 py-2 tracking-widest uppercase font-semibold text-lg">{{$date}}</h3>
                @foreach($record as $activity)
                    @include('profile.activity.'.$activity->type)  
                @endforeach
            @endforeach             
        </div>

        </div>
    </div>
        

    <div class=" pb-10 border-b border-gray-400 mx-10">
        {{-- {{$threads->links()}} --}}
    </div>

   
</x-app-layout>
