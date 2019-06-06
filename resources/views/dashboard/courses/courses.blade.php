 @extends('layouts.app')

@section('content')
<div class="grid-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table>
                        <tr>
                            <th>Title</th>
                            <th>Start Date</th>
                            <th>Duration</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($subscribedCourses as $subscription)
                            <tr>
                                <td><a href="{{$subscription->courses->path()}}">{{$subscription->courses->title}}</a></td>
                                <td>{{$subscription->created_at->diffForHumans()}}</td>
                                <td>{{$subscription->courses->duration . " Month(s)"}}</td>
                                <td>
                                    @if ($subscription->active)
                                        {{'active'}}
                                    @else
                                        {{'expired'}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>                    
                </div>
            </div>
        </div>
    </div>
    <flash></flash>
</div>
@endsection
