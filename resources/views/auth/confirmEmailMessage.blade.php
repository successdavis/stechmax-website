@extends('layouts.app')

@section('content')

<div class="grid-x  align-middle mt-3">
    <div class="grid-container">
        <p class="center-text">You're almost there...</p>
        <p>Please click on the link sent to your email address to confirm your account</p>
        <p class="center-text">Haven't received the confirmation email yet? <a class="small button" href="{{ route('register.resend_comfirmation') }}">Resend Email</a></p>
    </div>
</div>

</div>
@endsection
