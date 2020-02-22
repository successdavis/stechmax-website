@extends('layouts.app')
@section('head')
    <script src="https://www.google.com/recaptcha/api.js?render=6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM"></script>
@endsection
@section('content')
    <input type="hidden" name="token" id="token" value="">

    <div class="container">
        <div class="section">
            <div class="section" style="background: white">
                <site-registration mode="login" loginroute="/coporate/registration"></site-registration>
            </div>
        </div>
    </div>
@endsection