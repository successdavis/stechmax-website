<reply :attributes="{{$reply}}" inline-template v-cloak>
    <div id="reply-{{$reply->id}}" class="card">
        <div class="card-section">
            <div class="grid-x grid-margin-x">
                <div class="small-9 grid-container">
                    <h6><a href="/profiles/{{$reply->owner->email}}">{{$reply->owner->f_name . ' ' . $reply->owner->l_name}}</a>  said: {{$reply->created_at->diffForHumans()}}</h6>
                </div>
                <div class="small-3">
                @if (Auth::check())
                    <favorite :reply="{{ $reply }}"></favorite>
                @endif
                    {{-- @can ('update', $reply) --}}
                        <button class="small button" @click="destory"><i class="fas fa-trash"></i></button>
                    {{-- @endcan --}}
                </div>
            </div>
            <div v-if="editing">
                <textarea v-model="body"></textarea>
                <button class="small button" @click="update">Update</button>
                <button class="small button" @click="editing = false">Cancel</button>
            </div>
            
            <div v-else v-text="body"></div>
            {{-- @can ('update', $reply) --}}
                <div>
                    <button class="small button" @click="editing = true">Edit</button>
                </div>
            {{-- @endcan --}}
        </div>
    </div>
</reply>
