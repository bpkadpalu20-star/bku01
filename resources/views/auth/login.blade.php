@extends('layouts.app')

@section('content')
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h3>Welcome back!</h3>
                                            <h6 class="fw-medium mb-4 fs-17">Please sign in to continue.</h6>
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                            <label class="form-check-label" for="remember">
                                                                {{ __('Remember Me') }}
                                                            </label>
                                                        </div>

                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block w-100">Sign In</button>
                                            </form>
                                            <div class="main-signin-footer mt-5">
                                                @if (Route::has('password.request'))
                                                    <p class="mb-1"><a href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
@endsection
