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
			this.getSubjectQuery();
		},

		methods: {
			getSubjectQuery () {
				let subject = location.pathname.split('/')[2];
				subject ? this.sortedSubject = subject : this.sortedSubject = '';
				this.sortItems();
			},
			sortItems(e) {
				this.working = true;
				const url = `/courses${'/' + this.sortedSubject}?${this.sortItem}`;
				axios.get(url)
				.then(data => {
					this.courses = data.data.data;
					this.working = false;
					// history.pushState(null, null, url);
				})
				.catch(data => {
					this.working = false;
					flash(':) Something went wrong with sorting, please contact admin', 'failed');
				})
			}
		}
	}
</script>