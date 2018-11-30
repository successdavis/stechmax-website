<div class="cell large-2">
      <h6 class="bold"><strong>Channels</strong></h6>
      <ul>
      @foreach (App\Channel::all() as $channel)
          <li><a href="/threads/{{$channel->slug}}">{{$channel->name}}</a></li>
      @endforeach
          
      </ul>
</div>
