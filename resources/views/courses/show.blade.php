<p>{{$course->title}}</p>
@foreach ($course->childrenCourses as $course)
    <ul>
        <li>{{$course->title}}</li>
    </ul>
@endforeach
