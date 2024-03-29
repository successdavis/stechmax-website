<div>
               <div class="mb-3">
                  <h4 class="program-headlines">Course Type</h4>
                  <p>{{ucfirst($course->type->name)}}</p>
               </div>
               <div class="mb-3">
                  <h4 class="program-headlines">Course Price (Online Training Only)</h4>
                  <p> 
                     <span>&#8358;  <strike>{{$course->getAmount()}}</strike></span> 
                     <span class="is-size-5">&#8358;  {{$course->getDiscountAmount()}}</span>
                     <span style="padding: .4em; background: #90EE90; color: white;">{{$course->discount_percentage}}% OFF</span>
                  </p>
               </div>

               <div class="mb-3">
                  <h4 class="program-headlines">Course Price (Classroom + Online Training)</h4>
                     <span>&#8358;  <strike>{{$course->getClassAmount()}}</strike></span> 
                     <span class="is-size-5">&#8358;  {{$course->getClassAmountDiscount()}}</span>
                     @if($course->discount_percentage > 0)
                        <span style="padding: .4em; background: #90EE90; color: white;">{{$course->discount_percentage}}% OFF</span>

                     @endif
               </div>

               <div class="mb-3">
                  <h4 class="program-headlines">Category</h4>
                  <p>{{$course->subject->name}}</p>
               </div>

               <div class="mb-3">
                  <h4 class="program-headlines">Duration</h4>
                  <p>{{$course->duration . ' Weeks'}}</p>
               </div>

               <div class="mb-3">
                  <h4 class="program-headlines">Difficulty</h4>
                  <p>{{$course->difficulty->level}}</p>
               </div>

               <div class="mb-3">
                  <h4 class="program-headlines">Prerequisites</h4>
                  <ul>
                     @foreach ($course->requirements as $prerequisite)
                        <li>{{$prerequisite->body}}</li>
                     @endforeach
                  </ul>
               </div>
            </div>