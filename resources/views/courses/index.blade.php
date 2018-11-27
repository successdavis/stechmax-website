@foreach ($courses as $course)
    <a href="{{$course->path()}}">{{$course->title}}</a>
    <br>
@endforeach
