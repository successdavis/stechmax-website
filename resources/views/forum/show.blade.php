@extends('forum.layout')
@section('pageTitle')
  {{$thread->title}}
@endsection

	@section('forum_content')
	<thread-view :thread="{{$thread}}" inline-template>
			<div>
			    <div class="">
			        <article class="media">
					  <figure class="media-left">
					    <p class="image is-48x48">
					      <img class="is-rounded" src="{{$thread->creator->avatar_path}}">
					    </p>
					  </figure>
					  <div class="media-content">
					    <div class="content">
					      	<p>
					        	<strong>{{$thread->creator->username}}</strong>
					        	<small class="is-hidden-mobile">{{$thread->created_at->diffForHumans()}}</small>
					        	<br>
					      	</p>
					      	<div class="is-hidden-mobile">
				              	<p v-if="! editing" class="is-size-5 show_tr_title"><strong v-text="title"></strong></p>
				              	<p v-if="editing" class="is-size-5 show_tr_title">
					              <input v-model="form.title"  class="input" type="text" placeholder="Text input">
				              	</p>
						      	<p v-if="! editing" v-text="body" class="pre-formatted"></p>
						      	<textarea v-if="editing" v-model="form.body" class="textarea" placeholder="e.g. Hello world"></textarea>
						      	<div v-if="editing">
					            	<button class="button is-small" @click="update">Update</button>
					            	<button class="button is-small" @click="resetForm">Cancel</button>
					        	</div>
					        </div>
					    </div>
					    <nav class="is-hidden-mobile level is-mobile">
					      <div class="level-left">
					        <a class="level-item">
					          {{-- <span class="icon is-small"><i class="fas fa-reply"></i></span> --}}
					        </a>
					        <a class="level-item">
					          	@can('update', $thread )
				                    <form method="post" action="{{ $thread->path()}}" class="auto inline">
				                        @csrf
				                        {{method_field('DELETE')}}
				                        <button type="submit" class="is-small button"><i class="fas fa-trash"></i></button>
				                    </form>
				                @endcan
					        </a>
					        <a class="level-item">
					        	{{-- <div >
						            <button class="button small" @click="editing = true">Edit</button>
						        </div> --}}
					          <span
					          	v-if="authorize('owns', thread)"
					          	@click="editing = true"
					          	class="icon is-small">
					          	<i class="fas fa-edit"></i>
					          </span>
					        </a>
					      </div>
					    </nav>
					  </div>
					  <div class="media-right">
					  	<div class="is-hidden-mobile">
						  	<span>
		                        <i class="fas fa-eye"></i>
		                        {{$thread->visits}}
		                    </span>
						    <span class="tag is-light is-rounded"><i class="fas fa-comment"></i> {{$thread->replies_count}}</span>
					  	</div>
          				<span class="tag is-light is-rounded">{{$thread->channel->name}}</span>
          				<div class="mt-2 is-hidden-mobile">
		                    <subscribe-button
		                    	:active="{{json_encode($thread->isSubscribedTo)}}"
		                    	v-if="signedIn"
		                    ></subscribe-button>
          				</div>
                    	<button
                    		class="is-hidden-mobile	mt-1 button" v-if="authorize('isAdmin')"
                    		@click="toggleLock" v-text="locked ? 'Unlock' : 'Lock' "
                    	>Lock
                    	</button>

					  </div>
					</article>

					{{-- Thread content display only on mobile --}}
					<div class="is-hidden-tablet">
		              	<p v-if="! editing" class="mt-1"><strong v-text="title"></strong></p>
		              	<p v-if="editing" class="is-size-5 show_tr_title">
			              <input v-model="form.title"  class="input" type="text" placeholder="Text input">
		              	</p>
				      	<p v-if="! editing" v-text="body" class="pre-formatted"></p>
				      	<textarea v-if="editing" v-model="form.body" class="textarea" placeholder="e.g. Hello world"></textarea>
				      	<div v-if="editing">
			            	<button class="button is-small" @click="update">Update</button>
			            	<button class="button is-small" @click="resetForm">Cancel</button>
			        	</div>
			        </div>
			        <nav class="mt-2 is-hidden-tablet level is-mobile">
					      <div class="level-left">
					        <a class="level-item">
					          {{-- <span class="icon is-small"><i class="fas fa-reply"></i></span> --}}
					        </a>
					        <a class="level-item">
					          	@can('update', $thread )
				                    <form method="post" action="{{ $thread->path()}}" class="auto inline">
				                        @csrf
				                        {{method_field('DELETE')}}
				                        <button type="submit" class="is-small button"><i class="fas fa-trash"></i></button>
				                    </form>
				                @endcan
					        </a>
					        <a class="level-item">
					          <span
					          	v-if="authorize('owns', thread)"
					          	@click="editing = true"
					          	class="icon is-small">					        	{{-- <div >
						            <button class="button small" @click="editing = true">Edit</button>
						        </div> --}}

					          	<i class="fas fa-edit"></i>
					          </span>
					        </a>
							<div class="level-item">
			                    <subscribe-button
			                    	:active="{{json_encode($thread->isSubscribedTo)}}"
			                    	v-if="signedIn"
			                    ></subscribe-button>
	          				</div>
	                    	<button
	                    		class="level-item button" v-if="authorize('isAdmin')"
	                    		@click="toggleLock" v-text="locked ? 'Unlock' : 'Lock' "
	                    	>Lock
	                    	</button>
					      </div>
					    </nav>
			        <hr>

			        <replies @added="repliesCount++" @removed="repliesCount--"></replies>
			    </div>
			</div>
	</thread-view>
@endsection
