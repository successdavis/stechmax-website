<template>
  <!-- I will later add a toggle  -->
    <div class="grid-container">
        <form>
          <div class="grid-container">
            <div class="grid-x grid-padding-x">
              <div class="medium-2 cell">
                <label>Per page
                  <select v-model="perPage">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                  </select>
                </label>
              </div>
              <div class="medium-2 cell">
                <label>Status
                  <select v-model="status" @change="fetch">
                    <option >All</option>
                    <option value="true">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </label>
              </div>
              <div class="medium-2 cell">
                <label>Type
                  <select v-model="type" @change="fetch">
                    <option>All</option>
                    <option value="1">Course</option>
                    <option value="2">Track</option>
                    <option value="3">Practice</option>
                  </select>
                </label>
              </div>
              <div class="medium-6 cell">
                <label> Search
                    <div class="input-group">
                      <span class="input-group-label">Q</span>
                      <input v-model="search" class="input-group-field" type="text">
                      <div class="input-group-button">
                        <input type="submit" class="button" value="Search">
                      </div>
                    </div>
                </label>

              </div>
            </div>
          </div>
        </form>


        <div class="grid-x grid-padding-x small-up-2 medium-up-3">
          <div class="cell mt-3" v-for="course in items">
            <div class="card">
              <img :src="course.thumbnail_path">
              <div class="card-section">
                <span v-text="course.published"></span> |
                <span v-text="course.duration + ' weeks'"></span>

                <h4 v-text="course.title"></h4>
                <p v-text="course.sypnosis"></p>
              </div>
              <div class="grid-x grid-padding-x">
                  <a :href="course.path" target="_blank" class="cell small-6 small button">Visit</a>
                  <a :href="'/dashboard/' + course.slug + '/manage'" class="cell small-6 small button secondary">Edit</a>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3 mt-2">
          <paginator :dataSet="dataSet" @changed="fetch"></paginator>
        </div>
    </div>
</template>

<script>
    import collection from '../mixins/collection';

    export  default {
        data() {
            return {
                dataSet: false,
                items: [

                ],
                pagination: {
                    meta: { to: 1, from: 1 }
                },
                status: true,
                type: '1',
                search: '',
                currentPage: 1,
                perPage: 25,
                sortedColumn: 'title',
                order: 'asc' 
            };
        },

        created() {
            this.fetch();
            // Event.$on('newUserCreated', (user) => this.items.unshift(user));
        },

        methods: {
            fetch(page) {
                axios.get(this.url(page)).then(this.refresh);
            },

            url(page) {
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }
                return `${location.pathname}/datatable?page=${page}&column=${this.sortedColumn}&published=${this.status}&type_id=${this.type}&order=${this.order}&per_page=${this.perPage}`;
            },

            sortByColumn(column) {
                if (column === this.sortedColumn) {
                    this.order = (this.order === 'asc') ? 'desc' : 'asc'
                } else {
                    this.sortedColumn = column;
                    this.order = 'asc'
                }

                this.fetch()
            },

            refresh({data}) {
                this.dataSet = {
                    next_page_url : data.links.next,
                    current_page: data.meta.current_page,
                    per_page: data.meta.per_page,
                    total: data.meta.total,
                    prev_page_url: data.links.prev
                };
                this.items = data.data;
                this.pagination = data;

                window.scrollTo(0, 0);
            },
        }
    }
</script>

<style scoped>

</style>
