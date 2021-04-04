<div class="thread-create  py-2  bg-gray-200">

                    <h4 class="uppercase tracking-wide font-semibold text-md px-3 py-2">A new reply</h4>
                    <form action="{{$thread->path().'/replies'}}" method="POST" class="mx-10">
                        @csrf
                    <label>Comment</label>    
                    <input type="text" name="body" class="block mb-4 w-full "/>
                        
                                <x-button type="submit">
                                    Comment
                                </x-button>
                        
                         
                    </form>
                  
                </div>