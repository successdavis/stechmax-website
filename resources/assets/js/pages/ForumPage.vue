<script>
	
	export default {
		props: ['channels'],
		data () {
			return {
				sortItem: '',

				sortList: [
					{
						value: "All Threads",
						destination: "threads"
					},
					{
						value: "Solved",
						destination: "threads?answered=1"
					},
					{
						value: "Unsolved",
						destination: "threads?unanswered=1"
					},
					{
						value: "Popular All time",
						destination: "threads?popular=1"
					},
					{
						value: "Popular this week",
						destination: "threads?popular=1"
					},
					{
						value: "No replies Yet",
						destination: "threads?noreplies=true"
					},
				],
				loginsortlist: [
					{
						value: "My threads",
						destination: "threads?by=intermediate"
					},
					{
						value: "My Participation",
						destination: "threads?participation="
					},
					{
						value: "My Best Answers",
						destination: "threads?participation="
					},
					{
						value: "Following",
						destination: "threads?following=true"
					},

				]
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
			}
		}
	}

</script>