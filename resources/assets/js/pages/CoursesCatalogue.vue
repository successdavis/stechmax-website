<script>
	export default {
		props: ['subjectscatalogue'],
		data () {
			return {
				working: false,
				courses: '',
				subjects: this.subjectscatalogue,
				sortedSubject: '',
				sortItem: '',
				sortList: [
					{
						value: "Price: Low to High",
						destination: "amount=asc",
					},
					{
						value: "Price: High to Low",
						destination: "amount=desc"
					},
					{
						value: "Alphabetically",
						destination: "alphabet=asc"
					},
					{
						value: "Beginner",
						destination: "difficulty=beginner"
					},
					{
						value: "Intermediate",
						destination: "difficulty=intermediate"
					},
					{
						value: "Advance",
						destination: "difficulty=advance"
					},
					{
						value: "Tracks Only",
						destination: "type=track"
					},
					{
						value: "Courses Only",
						destination: "type=course"
					},
					{
						value: "Programs Only",
						destination: "type=program"
					},
					{
						value: "Practice Only",
						destination: "type=practice"
					}
				]
			}
		},

		mounted () {
			axios.get(location.href).then(data => {
				this.courses = data.data.data;
			})
			// this.getCourses();
		},

		methods: {
			sortItems(e) {
				this.working = true;
				const url = `/courses${'/' + this.sortedSubject}?${this.sortItem}`;
				axios.get(url)
				.then(data => {
					this.courses = data.data.data;
					this.working = false;
					history.pushState(null, null, url);
				})
				.catch(data => {
					this.working = false;
					flash(':) Something went wrong with sorting, please contact admin', 'failed');
				})
			},
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