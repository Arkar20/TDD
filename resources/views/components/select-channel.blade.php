<div>
      <select type="text" name="channel_id" class="block mb-4 w-full ">
                        <option value="">Choose the channel</option>
                        @foreach ($channels as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                        
      </select>  <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
</div>