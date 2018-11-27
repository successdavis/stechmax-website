<ul>
    @foreach ($threads as $thread)
        <li> <a href="{{ $thread->path() }}">{{$thread->title}}</a></li>
    @endforeach
</ul>
