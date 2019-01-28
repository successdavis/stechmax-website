@extends('profiles.layouts.profile')

@section('profile_content')
    <table>
        <tr>
            <th>Title</th>
            <th>Start Date</th>
            <th>Duration</th>
            <th>Status</th>
        </tr>
        @foreach ($subscriptions as $subscription)
            <tr>
                <td>{{$subscription->courses->title}}</td>
                <td>{{$subscription->created_at->diffForHumans()}}</td>
                <td>{{$subscription->courses->duration}}</td>
                <td>{{$subscription->active}}</td>
            </tr>
        @endforeach
    </table>
@endsection

