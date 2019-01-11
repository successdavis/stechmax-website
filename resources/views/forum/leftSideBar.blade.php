<div class="cell medium-3 large-2">
    <a href="/threads/new" class="button">POST A QUESTION</a>
    <ul>
        <li><a class="gray-20" href="/threads">All Threads</a></li>
        @if (auth()->check())
        <li><a href="/threads?by={{auth()->user()->name}}">My Threads</a></li>
        @endif
        <li><a href="/threads?popular=1">Popular All time</a></li>
    </ul>
</div>
