@extends('layouts.app')
@section('content')
<study-room :sections="{{$sections}}" :course="{{$course}}" inline-template>
	<div class="columns">
		<div class="column is-9">
	    	<vid-player @readied="readied" @nowplaying="updateNowPlaying(e)" :playerdata="playerdata"></vid-player>
		</div>
		<div class="column is is-3">
			<div v-for="(section, index) in sections" :key="section.id">
				
				<div class="study_section mb_small" v-text="section.title" ></div>

				<div class="study_section_lecture"
					v-for="(lecture, index) in section.lectures" 
					:class="lectureIndex(lecture) ? 'playing' : '' " 
					v-text="lecture.title" 
					:key="lecture.id"
					@click="skipto(lecture)"
				>
				</div>
			</div>
		</div>
	</div>
</study-room>
@endsection
