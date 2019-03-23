<ul class="vertical dropdown menu" data-dropdown-menu style="max-width: 250px;">
   @foreach ($subjects as $subject)
     <li>
       <a href="/courses/{{$subject->slug}}">{{$subject->name}}</a>
       <ul class="vertical menu nested">
        @foreach ($subject->courses as $course)
         <li><a href="#">{{$course->title}}</a></li>
        @endforeach
       </ul>
     </li>
   @endforeach
</ul>

