@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
    <div class="grid-container">
        {{-- Breadcrumbs --}}
        <div class="grid-container">
            <nav aria-label="You are here:" role="navigation" class="mt-2">
                <ul class="breadcrumbs">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Courses</a></li>
                    {{-- <li class="disabled">Gene Splicing</li> --}}
                    <li>
                        <span class="show-for-sr">Courses: </span> View All Courses
                    </li>
                </ul>
            </nav>
        </div>

        {{-- Content --}}
        <div class="grid-container mt-2">
            <div class="bg-white">
                <view-all-courses></view-all-courses>
            </div>
        </div>
@endsection
