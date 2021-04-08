 <div class="bg-white rounded-md shadow  mb-4">
                    <div class="header py-3 border-b border-gray-400 bg-gray-100"> 
                    <a  class="px-4 py-2 text-md flex justify-between" href="{{$activity->subject->owner}}">
                        <p class="inline-block text-lg text-blue-700 uppercase tracking-wide">
                        {{$activity->subject->title}}
                    <span class="text-xs text-gray-400 italic">
                                {{$activity->created_at->diffForHumans()}}
                        </span>
                        </p> 
                    
                        <p class="inline-block text-lg text-blue-700"> {{$activity->subject->replies_count}} {{Str::plural('reply',$activity->replies_count)}}</p>
                    </a>   
                    <a class="px-4 py-2">{{$activity->subject->author->name}}</a>
                    </div>
                    <div class="body mx-auto text-gray-500 px-3 py-6">
                        <p>{{$activity->subject->body}}</p>
                    </div>
                </div>