<!--Upload Course thumbnail-->
        <div v-if="step === 6" class="grid-container">
            <h5 class="center-text mt-2">Step Two <i class="fas fa-angle-double-right"></i>  Upload Course Thumbnail </h5>

            <p>Select Course thumbnail</p>
            <courseThumbnail :data="activeCourse"></courseThumbnail>
        </div>

        <!--Add other course details-->
        <div v-if="step === 6">
            <h5 class="center-text mt-2">Step Three <i class="fas fa-angle-double-right"></i>  Other Course Details </h5>

            <courseExtraDetails :data="activeCourse"></courseExtraDetails>

        </div>
        <div v-if="step === 6">
            <h5 class="center-text mt-2">Step Four <i class="fas fa-angle-double-right"></i>  Create Sections And Topics </h5>

            <courseSections :data="activeCourse"></courseSections>

        </div>
