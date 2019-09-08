@extends('layouts.app')

@section('content')
    <div class="grid-container">
        {{-- Breadcrumbs --}}
        <div class="grid-container">
            <nav aria-label="You are here:" role="navigation" class="mt-2">
                <ul class="breadcrumbs">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Invoices</a></li>
                    <li>
                        <span class="show-for-sr">Create Invoices: </span> View Invoices
                    </li>
                </ul>
            </nav>
        </div>
        {{-- Content --}}
        <div class="grid-container mt-2">
            <div class="bg-white">
                <create-invoices :user="{{auth()->user()}}"></create-invoices>
            </div>
        </div>
@endsection