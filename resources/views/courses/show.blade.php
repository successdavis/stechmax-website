@extends('layouts.app')

@section('content')
        @include("courses.partials._courseStreamer")
        @include("courses.partials._tabs")
        

        {{-- Tabs Content Begins here --}}
<div class="grid-container">

    <div class="tabs-content" data-tabs-content="example-tabs">
        {{-- Course Content Tab --}} 
        @include('courses.partials._contentTab')
        @include('courses.partials._instructorsTab')
    </div>
</div>

</div>
@endsection
