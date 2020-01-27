<course-streamer 
    :course="{{$course}}" 
    :subject="{{$course->subject}}" 
    :learns="{{$course->learns()->limit(3)->get()}}" 
    :course_path="{{json_encode($course->path())}}"
    :type="{{json_encode($course->type->name)}}"
    :videourl="{{json_encode($course->videopath)}}"
></course-streamer>