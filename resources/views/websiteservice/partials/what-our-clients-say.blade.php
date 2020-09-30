
<div class="section has-text-centered">
    <h2 class="title">Here is what our Clients Say</h2>
</div>

<image-carousel :wraparound="true" :autoplay="true" >
    @foreach($clienttestimonial as $testimonial)
       <section class="hero is-primary is-medium" style="width: 100%; height: 400px">
          <div class="hero-body">
              <div class="columns">
                  <div class="column is-4">
                        <p>Photo Side</p>
                  </div>
                  <div class="column is-6 container">
                      <h1 class="title">
                         {{$testimonial->client->fullname}}
                      </h1>
                      <h2 class="subtitle">
                        {{$testimonial->testimonial}}
                      </h2>
                  </div>
              </div>
          </div>
        </section>
    @endforeach
</image-carousel>
