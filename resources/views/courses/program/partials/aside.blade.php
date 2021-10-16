<div>
               <div class="mb-3">
                  <h4 class="program-headlines">Course Type</h4>
                  <p>{{ucfirst($course->type->name)}}</p>
               </div>
               <div class="mb-3">
                  <h4 class="program-headlines">Course Price</h4>
                  <p> 
                     <span>&#8358;  <strike>{{$course->getAmount()}}</strike></span> 
                     <span class="is-size-5">&#8358;  {{$course->getDiscountAmount()}}</span>
                     <span style="padding: .4em; background: #90EE90; color: white;">{{$course->discount_percentage}}% off</span>
                  </p>
               </div>

               <div class="mb-3">
                  <h4 class="program-headlines">Course Price (Classroom)</h4>
                  <p>  &#8358;  {{$course->getClassAmountDiscount()}}</p>
               </div>

               <div class="mb-3">
                  <h4 class="program-headlines">Category</h4>
                  <p>{{$course->subject->name}}</p>
               </div>

               <div class="mb-3">
                  <h4 class="program-headlines">Duration</h4>
                  <p>{{$course->duration . ' Months'}}</p>
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