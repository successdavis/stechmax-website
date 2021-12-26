@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section">
            <div class="card-header">{{ __('Reset Password') }}</div>

            <div class="">
                <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group row is-hidden">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="input" name="email" value="{{ app('request')->input('email') }}" required autofocus>

                        </div>
                    </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="input" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="button is-primary">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>
@endsection