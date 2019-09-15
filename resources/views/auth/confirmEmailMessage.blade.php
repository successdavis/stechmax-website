@extends('layouts.app')

@section('content')
    <account-confirmation :user="{{auth()->user()}}"></account-confirmation>
</div>

</div>
@endsection
