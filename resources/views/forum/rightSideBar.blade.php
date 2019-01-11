<div class="cell large-2">
      <h6 class="bold"><strong>Channels</strong></h6>
      <ul>
      @foreach ($channels as $channel)
          <li><a class="gray-20" href="/threads/{{$channel->slug}}">{{$channel->name}}</a></li>
      @endforeach
          
      </ul>
</div>
