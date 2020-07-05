<nav class="panel bg-white">
  <p class="panel-heading">
    <strong>Your Performance</strong>
  </p>

  @forelse ($experiences as $experience)
    <a class="panel-block is-active">
      <span class="panel-icon">
        <i class="mdi mdi-trophy-award" aria-hidden="true"></i>
      </span>
      <div class="columns is-multiline is-mobile" style="width: 100%">
        <div class="column is-8">{{$experience->description}}</div>
        <div class="column is-4">{{$experience->points}}</div>
      </div>
      
    </a>
  @empty
    <p class="section">No Experience earned yet</p>
  @endforelse
</nav>