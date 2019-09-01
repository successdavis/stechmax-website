@extends('layouts.app')

@section('content')
    <div class="grid-container">
        {{-- Breadcrumbs --}}
        <div class="grid-container">
            <nav aria-label="You are here:" role="navigation" class="mt-2">
                <ul class="breadcrumbs">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Mycourses</a></li>
<!--                     <li>
                        <span class="show-for-sr">Course Registration: </span> Course Registration
                    </li> -->
                </ul>
            </nav>
        </div>
        {{-- Content --}}
        <div class="grid-container mt-2">
            <div class="bg-white">
                <user-courses :user="{{auth()->user()}}"></user-courses>
            </div>
        </div>
@endsection
