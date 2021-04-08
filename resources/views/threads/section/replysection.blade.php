<div class="bg-white rounded-md shadow  mb-4">
            <div class="header py-3 border-b border-gray-400 bg-gray-100 flex justify-between"> 
              <a  class="px-4 py-2 text-md" href="{{$thread->path()}}">
                <p class="inline-block text-lg text-blue-700">
                    {{$reply->owner->name}}
                </p> Created At: 
                {{$reply->created_at->diffForHumans()}}
               
            </a>   
            <div>
                {{$reply->favourites_count}} {{Str::plural('favourites',$reply->favourites_count)}}      
               
                <form action="{{ route('reply.favourite', $reply->id) }}" method="POST">
                    @csrf
                           <button type="submit" 
                           {{$reply->isFavourited()?'disabled':''}}
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150' " >
                           
                           Favorite</button>
                    
                        </form>
            </div>

            </div>
            <div class="body mx-auto text-gray-500 px-3 py-6">
                <p>{{$reply->body}}</p>
            </div>
        </div>