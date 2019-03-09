{{-- if in editing mode --}}

<div class="card" v-if="editing" v-cloak>  
    <div class="card-section">
        <div class="card-title grid-x">
            <div class="medium-8">
                <img class="avater-image" src="{{$thread->creator->avatar_path}}" style="width: 30px; height: 30px" >

                <h6><strong><a href="/profiles/{{$thread->creator->f_name . $thread->creator->l_name}}">{{$thread->creator->f_name . ' ' . $thread->creator->l_name}}</a> </strong> | {{$thread->created_at->diffForHumans()}}
                </h6>
            </div>
            <div class="medium-4">
                <span class="p-text-grey-darker" v-text="repliesCount">
                    <i class="fi-comment-minus"></i>
                </span>
                <span>
                    <a class="p_red-tiny-button" href="/threads/{{$thread->channel->slug}}">{{$thread->channel->name}}</a>
                </span>
            </div>
        </div>
        <div class="">
            <input type="text" v-model="form.title">
        </div>
            <textarea rows="5" v-model="form.body"></textarea>
        <div>
            <button class="button small" @click="update">Update</button>
            <button class="button small" @click="resetForm">Cancel</button>
        </div>
    </div>
</div>


{{-- if not in editing mode --}}

<div class="card" v-if="! editing">  
    <div class="card-section">
        <div class="card-title grid-x">
            <div class="medium-8">
                <img class="avater-image" src="{{$thread->creator->avatar_path}}" style="width: 30px; height: 30px" >

                <h6><strong><a href="/profiles/{{$thread->creator->f_name . $thread->creator->l_name}}">{{$thread->creator->f_name . ' ' . $thread->creator->l_name}}</a> </strong> | {{$thread->created_at->diffForHumans()}}
                </h6>
            </div>
            <div class="medium-4">
                <span class="p-text-grey-darker" v-text="repliesCount">
                    <i class="fi-comment-minus"></i>
                </span>
                <span>
                    <a class="p_red-tiny-button" href="/threads/{{$thread->channel->slug}}">{{$thread->channel->name}}</a>
                </span>
                @can('update', $thread )
                    <form method="post" action="{{ $thread->path()}}" class="auto inline">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit" class="small mb-reset"><i class="fas fa-trash"></i></button>
                    </form>
                @endcan
                <span>
                    <subscribe-button :active="{{json_encode($thread->isSubscribedTo)}}" v-if="signedIn"></subscribe-button>
                    <button class="small button" v-if="authorize('isAdmin')" @click="toggleLock" v-text="locked ? 'Unlock' : 'Lock' ">Lock</button>
                </span>
            </div>
        </div>
        <div class="thread-header" v-text="title">
            
        </div>
        <p v-text="body"></p>
        <div v-if="authorize('owns', thread)">
            <button class="button small" @click="editing = true">Edit</button>
        </div>
    </div>
</div>
