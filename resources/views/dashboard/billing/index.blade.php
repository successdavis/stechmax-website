 @extends('layouts.app')

@section('content')
<div class="grid-container">
    <billing :user="{{auth()->user()}}"></billing>
</div>
@endsection
