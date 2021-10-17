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
          <div class="column">
            <span v-if="course.subject.length<9" v-text="course.subject"></span>
            <span v-else v-text="course.subject.substring(0,7)+'..'"></span>
          </div>
        </div>
          <h4 v-text="course.title"></h4>
          {{-- <p v-text="course.sypnosis"></p> --}}
        </div>
      </div>
      <footer class="card-footer">
        <a :href="course.path" class="card-footer-item" v-if="course.discount_amount !== '0.00' ">
            &#8358;<span v-text="course.discount_amount "></span> 

              <span class="is-size-7 " style="color: #90EE90;"> {{" "}}. @{{course.discount}}% OFF</span>

        </a>
        <a :href="course.path" class="card-footer-item" v-else>
            <span>&#8358; 0 FREE</span>
        </a>
        <a :href="course.path" class="card-footer-item">View</a>
      </footer>
    </div>
  </a>
</div>