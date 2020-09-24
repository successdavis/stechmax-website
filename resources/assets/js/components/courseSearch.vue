<template>
	<div class="width-modifier">
        <div class="field">
          <div class="control" :class="isLoading ? 'is-loading' : ''">
            <input @keyup="courseSearch" v-model="CourseSearch"  class="input is-rounded is-medium" type="text" placeholder="Search through courses">
          </div>
        </div>

		<div class="searchResult" v-if="results">
			<ul>
				<li class="result-item" v-for="result in results"><a class="has-text-black	" :href="result.path"  v-text="result.title"></a></li>
			</ul>
		</div>
	</div>
</template>

<script>
    // $url = 'threads?search=search keywords';
    import _ from 'lodash';
	export default {
		props: {
			forum: true,
		},
		data () {
			return {
				enableForum: this.forum,
				isLoading: false,
				results: '',
				CourseSearch: '',
				ForumSearch: '',
			}
		},

        computed: {

        },

		methods: {
			courseSearch: _.debounce(function(page) {
                this.isLoading = true;
                this.courseFetch();
            }, 600),

			threadSearch: _.debounce(function(page) {
                this.isLoading = true;
                this.threadFetch();
            }, 600),

			courseFetch() {
				if (this.CourseSearch === '') {this.results = ''; return}
				axios.get(`/courses?search=${this.CourseSearch}`)
				.then(data => {
					this.results = data.data.data;
                    this.isLoading = false;
				})
				.catch(error => {
					console.log(error);
				})
			},
		}
	};
</script>

<style scoped>
	.searchResult {
		background: #baffd2;
		padding: 1.5em;
	}
    .result-item {
        padding: 1em .5em;
        cursor: pointer;
    }
    .result-item:hover {
        background: rgba(255,255,255,.7);
    }



    @media (min-width: 769px) {
        .width-modifier {
            width: 50%;
        }
    }
    /*.width-modifier*/
</style>
