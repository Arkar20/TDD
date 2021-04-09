<div class="container">

                    <h4 class="uppercase tracking-wide font-semibold text-md px-3 py-2">A new thread</h4>
                    <form action="{{route('thread.store')}}" method="POST" class="mx-10">
                        @csrf
                    <label>Title</label>    
                    <input type="text" class="form-control" name="title" class="block mb-4 w-full "/>
                  
                    <label>Slug</label>    
                        <x-select-channel />
                        <label class="block">Body</label>
                    <textarea name="body" id="" class="w-full mb-4" rows="10">

                    </textarea>
                                <x-button type="submit">
                                    Create
                                </x-button>
                        
                     
                    </form>
                  
                </div>