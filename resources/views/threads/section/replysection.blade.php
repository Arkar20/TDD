<div class="bg-white rounded-md shadow  mb-4">
                  <div class="header py-3 border-b border-gray-400 bg-gray-100"> 
              <a  class="px-4 py-2 text-md" href="{{$thread->path()}}">
                <p class="inline-block text-lg text-blue-700">{{$reply->owner->name}}</p> Created At: 
                {{$reply->created_at->diffForHumans()}}
               
            </a>   
            </div>
            <div class="body mx-auto text-gray-500 px-3 py-6">
                <p>{{$reply->body}}</p>
            </div>
        </div>