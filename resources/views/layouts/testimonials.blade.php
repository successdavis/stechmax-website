<section class="section">
  <span class="container has-text-centered">
    <h2 class="title">What are students say</h2>
      <image-carousel :wraparound="true" :autoplay="true" >
        @foreach ($testimonials as $testimony)
            <span class="testimonial-child" style="width: 49%">
              <div class="level">
                <div class="level-item">
                  <figure class="image is-128x128"><img class="is-rounded" src="{{$testimony->user->passport_path}}" alt="Testified user image"></figure>
                </div>
              </div>
              <p class="block has-text-centered">{{$testimony->testimonial}}</p>
              <h5 class="title is-5">{{$testimony->user->f_name . ' ' . $testimony->user->m_name }}</h5>
            </span>
        @endforeach
      </image-carousel>
  </div>
</section>
