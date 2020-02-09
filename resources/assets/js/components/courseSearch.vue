<template>
	<div class="">
		<tabs>
			<tab name="Course" :selected="true">
				<div class="control">
				  	<input @keyup="courseSearch" v-model="CourseSearch" :class="isLoading ? 'isLoading' : ''" class="input is-medium" type="text" name="q" placeholder="Start typing to search through courses">
				</div>
			</tab>
			<tab name="Forum" >
				<div class="control">
				  <input @keyup="threadSearch" v-model="ForumSearch" class="input is-medium" type="text" name="q" placeholder="Type to search forum">
				</div>
			</tab>
		</tabs>
		<div class="searchResult" v-if="results">
			<ul>
				<li v-for="result in results" v-text="result.title"></li>
			</ul>
		</div>
	</div>
</template>

<script>
    // $url = 'threads?search=search keywords';
    import _ from 'lodash';
	export default {
		data () {
			return {
				isLoading: false,
				results: '',
				CourseSearch: '',
				ForumSearch: '',
			}
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
				if (this.CourseSearch == '') {this.results = ''; return}
				axios.get(`/courses?search=${this.CourseSearch}`)
				.then(data => {
					this.results = data.data;
				})
				.catch(error => {
					console.log(error);
				})
			},
			
			threadFetch() {
				if (this.ForumSearch == '') {this.results = ''; return}
				axios.get(`/threads?search=${this.ForumSearch}`)
				.then(data => {
					console.log(data.data);
					this.results = data.data.data;
				})
				.catch(error => {
					console.log(error);
				})
			}
		}
	};
</script>

<style scoped>
	.searchResult {
		background: #baffd2;
		padding: 1em;
	}
</style>