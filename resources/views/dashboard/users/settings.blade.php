
@extends('layouts.app')

@section('content')
    <div class="grid-container">
        {{-- Breadcrumbs --}}
        <div class="grid-container">
            <nav aria-label="You are here:" role="navigation" class="mt-2">
                <ul class="breadcrumbs">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Settings</a></li>
                    {{-- <li class="disabled"></li> --}}
                    <li>
                        <span class="show-for-sr">Update Profile </span> Modify 
                    </li>
                </ul>
            </nav>
        </div>

        {{-- Content --}}
        <div class="grid-container mt-2">
            <div class="bg-white">
                <user-setting :User="{{auth()->user()}}"></user-setting>
            </div>
        </div>
@endsection
