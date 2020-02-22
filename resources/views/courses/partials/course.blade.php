<div class="column is-3" v-for="(course, index) in courses">
  <a :href="course.path">
    <div class="card">
      <div class="card-image">
        <figure class="image is-4by3">
          <img img :src="course.thumbnail_path" :alt="course.title">
        </figure>
      </div>
      <div class="card-content">
        <div class="content">
        <div class="columns is-mobile">
          <div class="column">
            <span v-text="course.difficulty"></span>
          </div>
          <div class="column">
            <span v-text="course.type"></span>
          </div>
        </div>
          <h4 v-text="course.title"></h4>
          {{-- <p v-text="course.sypnosis"></p> --}}
        </div>
      </div>
      <footer class="card-footer">
        <a href="#" class="card-footer-item">&#8358;<span v-text="course.amount"></span></a>
        <a :href="course.path" class="card-footer-item">View</a>
      </footer>
    </div>
  </a>
</div>