@extends('layouts.app')

@section('content')
<thread-view :thread="{{$thread}}" inline-template>
<div class="grid-container">

<div class="grid-x grid-margin-x mt-3"> 
   
    @include('forum.leftSideBar')
   
    <div class="cell medium-8 large-8">
        @include('forum._question')
        <hr>

            <replies @added="repliesCount++" @removed="repliesCount--"></replies>
           
    </div>
    {{-- ================================================= --}}
  @include('forum.rightSideBar')
</div>
</div>
</thread-view>
@endsection
