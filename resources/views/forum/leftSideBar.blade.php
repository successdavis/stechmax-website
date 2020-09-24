@if (Auth::check())
    @if(! auth()->user()->confirmed && !auth()->user()->phone_confirmed)
        <p class="block">One Step! Please <a href="/register/comfirm_email">confirm</a> your account</p>
    @else
        <new-thread :channels="{{$channels}}"></new-thread>
    @endif
@else
    <p class="block">Hi! Please <a href="/login">SignIn</a> to Ask a Question</p>
@endif

<div class="">
	<div class="columns">
		<i class="column is-1 fab fa-forumbee"></i>
	    <a class="column" href="/threads">All Threads</a>
	</div>
    @if (auth()->check())
    	<div class="columns">
    		<i class="column is-1 fas fa-question-circle"></i>
	    	<a class="column" href="/threads?by={{auth()->user()->username}}">My Threads</a>
    	</div>
    	<div class="columns">
    		<i class="column is-1 fas fa-signature"></i>
	    	<a class="column" href="/threads?participation={{auth()->user()->username}}">My Participation</a>
    	</div>
    @endif
    <div class="columns">
	    <i class="column is-1 fas fa-check-circle"></i>
	    <a class="column" href="/threads?solved=1">Solved</a>
    </div>
    <div class="columns">
	    <i class="column is-1 far fa-times-circle"></i>
	    <a class="column" href="/threads?unsolved=1">Unsolved</a>
    </div>
    <div class="columns">
	    <i class="column is-1 fab fa-ioxhost"></i>
	    <a class="column" href="/threads?unanswered=true">No replies Yet</a>
    </div>
    {{-- <a class="column is-12" href="/threads?popular=1">Popular All time</a> --}}
</div>
