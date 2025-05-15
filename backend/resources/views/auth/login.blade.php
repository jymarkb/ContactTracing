@extends('layouts.app')

@section('content')
<div class="container p-5">
    <div class="row justify-content-center mt-5">
        <div class="col-xl-6 col-lg-7 col-md-10 col-sm-10 col-12 mt-5 col-login p-5">
            <p class="mt-2 mb-3 title-login">ACCOUNT LOGIN</p>

            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="form-group form-login">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control @error('users_username') is-invalid @enderror @if (session()->has('loginError')) is-invalid @endif" name="users_username" value="{{ old('users_username') }}" required autocomplete="false">
                        @error('users_username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        @if (session()->has('loginError'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{session()->get('loginError')}}</strong>
                        </span>
                        @endif
                  
                </div>
                <div class="form-group form-login">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <!-- <div class="justify-content-center text-right">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div> -->

                <button type="submit" class="btn btn-primary btn-block mt-5 mb-2 login-btn">
                    {{ __('Login') }}
                </button>
            </form>

        </div>
    </div>
</div>


@endsection
