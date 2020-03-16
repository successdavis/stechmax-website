 @extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
    <billing :user="{{auth()->user()}}"></billing>
@endsection
