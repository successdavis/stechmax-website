@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
    <div class="bg-white">
        <view-all-courses inline-template>
            @include('dashboard.courses.partials.coursesdatatable')
        </view-all-courses>
    </div>
@endsection
