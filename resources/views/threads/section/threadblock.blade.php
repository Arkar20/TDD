

 <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      <a  class="" href=">
                        {{$thread->path()}}">
                <h3 class="">
                      {{$thread->title}}
               <span class="">
                        {{$thread->created_at->diffForHumans()}}
                   </span>
                </h3> 
                                <p class="inline-block text-lg text-blue-700"> {{$thread->replies_count}} {{Str::plural('reply',$thread->replies_count)}}</p>

              </div>

                    <div class="card-body">
                                        <p>{{$thread->body}}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>