
@extends('profiles.layouts.profile')

@section('profile_content')
        @forelse ($activities as $date => $activity)
            <h4>{{ $date }}</h4>
            @foreach ($activity as $record)
                @if (view()->exists("profiles.activities.{$record->type}"))
                    @include ("profiles.activities.{$record->type}", ['activity' => $record])
                @endif
            @endforeach
        @empty
            <p>There is no activity for this User yet</p>
        @endforelse
@endsection

