{{$thread->title}}

@foreach ($thread->replies as $reply)
    <p>
        <a href="">{{$reply->owner->name}}</a>  said: {{$reply->created_at->diffForHumans()}}
        {{$reply->body}}
    </p>
@endforeach
