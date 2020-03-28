<script>
	
	export default {
		props: ['channels', 'user'],
		data () {
			return {
				working: false,
				sortItem: '',
				sortChannel: '',
				
				sortList: [
					{
						value: "All Threads",
						destination: ""
					},
					{
						value: "solved",
						destination: "?solved=1"
					},
					{
						value: "Unsolved",
						destination: "?unsolved=1"
					},
					// {
					// 	value: "Popular All time",
					// 	destination: "?popular=1"
					// },
					// {
					// 	value: "Popular this week",
					// 	destination: "?popular=1"
					// },
					{
						value: "No replies Yet",
						destination: "?unanswered=true"
					},
				],
				loginsortlist: [
					{
						value: "My threads",
						destination: "threads?by=JohnDoe4"
					},
					{
						value: "My Participation",
						destination: "?participation=JohnDoe4"
					},
					// {
					// 	value: "My Best Answers",
					// 	destination: "?bestanswer=JohnDoe4"
					// },
					// {
					// 	value: "Following",
					// 	destination: "?following=true"
					// },

				]
			}
		},

		computed: {
			username () {
				return window.user;
			}
		},

		methods: {
			getCourses() {
				this.working = true;
				axios.get('/courses')
				.then(data => {
					this.working = false;
					this.courses = data.data.data;
				})
				.catch(error => {
					this.working = false;
					flash("Something isn\'t right please check your connection");
				})
			},

			SortThreadsByList () {
				this.working = true;
				window.location.href = `${this.sortItem}`;
			},

			sortthreadbychanel () {
				this.working = true;
				window.location.href = `/threads/${this.sortChannel}`
			}
		}
	}

</script>