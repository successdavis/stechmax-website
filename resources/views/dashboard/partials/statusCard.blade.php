<div class="dashboard_card grid-x grid-margin-x">
	<div class="status__card grid-x cell medium-4">
		<div class="small-6 status__card--icon">
			<i class="fas fa-trophy"></i>
		</div>
		<div class="small-6">
			<p>Points Earned</p>
			0
		</div>
	</div>
	<div class="status__card grid-x cell medium-4">
		<div class="small-6 status__card--icon">
			<i class="fas fa-project-diagram"></i>
		</div>
		<div class="small-6" style="color: yellowgreen">
			<p>Projects Completed</p>
			0
		</div>
	</div>
	<div class="status__card grid-x cell medium-4">
		<div class="small-6 status__card--icon" style="color: brown">
			<i class="fas fa-window-restore"></i>
		</div>
		<div class="small-6">
			<p>You have</p>
			{{auth()->user()->totalActiveCourse()}} active Courses
		</div>
	</div>
</div>