@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/login/login_form.css') }}">

<div class="centered">
    <h1 class="display-5 text-dark font-weight-bold d-flex justify-content-center pb-5">Task Management System</h1>

    <div class="container d-flex justify-content-center">
        <form method="POST" action="{{ route('login-validation') }}">
        @csrf

        @if($errors->has('authFailure'))
        <div class="alert alert-danger container">
            <strong>These credentials do not match our records! Please check your email or password.</strong><br>
        </div>
        @endif
        <div class="row container-fluid">
            <div class="col">
                <div class="form-group form-inline d-flex justify-content-center">
                    <label for="email" class="col-4 d-flex justify-content-start text-dark display-8">Email:</label>
                    <input type="email" name="email" id="email" class="form-control col-8" value="{{old('email')}}"> 
                </div>
                @if ($errors->has('email'))
                <p class="text-danger container-fluid text-center"><strong>{{ $errors->first('email') }}</strong></p>
                @endif
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col">
                <div class="form-group form-inline d-flex justify-content-center">
                    <label for="email" class="col-4 d-flex justify-content-start text-dark display-8">Password:</label>
                    <input type="password" name="password" id="password" class="form-control col-8"> 
                </div>
                @if ($errors->has('password'))
                <p class="text-danger container-fluid text-center"><strong>{{ $errors->first('password') }}</strong></p>
                @endif
            </div>
        </div>
        <div class="form-group d-flex justify-content-center offset-md-3">
            <div class="col-4">  
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="checkbox" class="text-sm form-check-label">Remember me</label>
            </div>
            <div><a href="forgot-password" class="text-sm">Forgot Password?</a></div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary col-2 mt-3" id="login_btn">Log In</button>
        </div>
        
        </form>
    </div>
</div>
@endsection
