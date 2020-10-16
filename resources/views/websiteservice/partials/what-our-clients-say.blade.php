
<div class="section has-text-centered">
    <h2 class="title">Here is what our Clients Say</h2>
</div>

<image-carousel :wraparound="true" :autoplay="true" v-cloak>
    @foreach($clienttestimonial as $testimonial)
       <section class="hero is-primary is-medium" style="width: 100%; height: auto">
          <div class="hero-body" style="padding: 3rem 1.5rem">
              <div class="columns">
                  <div class="column is-4">
                      <div class="is-flex is-horizontal-center">
                        <figure class="image is-256x256">
                          <img style="width: 300px; border: 5px solid;" class="is-rounded" src="{{$testimonial->client->image_path}}">
                        </figure>
                      </div>

                  </div>
                  <div class="column is-6 is-flex align-center is-horizontal-center flex-column">
                      <h1 class="title has-text-centered">
                         {{$testimonial->client->title . ' ' . $testimonial->client->fullname}}
                      </h1>
                      <h2 class="subtitle has-text-centered">
                        {{$testimonial->testimonial}}
                      </h2>
                  </div>
              </div>
          </div>
        </section>
    @endforeach
</image-carousel>
