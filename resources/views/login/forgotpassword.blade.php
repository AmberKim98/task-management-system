@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login/login_form.css') }}">

<div class="centered">
    <h1 class="display-8 text-dark font-weight-bold d-flex justify-content-center pb-5 text-center">Please enter your email and we'll send you a link to create a new password.</h1>
    @if(session('success'))
        <div class="alert alert-success container d-flex col-md-5 justify-content-center">Reset Password Link was successfully sent to your email!</div>
    @endif
    <div class="container-fluid d-flex justify-content-center">
        <form method="POST" action="{{ route('forgot.password.post') }}">
            @csrf
            <div class="form-group form-inline container-fluid">
                <label for="email" class="d-flex justify-content-start text-dark display-8 col-3">Email:</label>
                <input type="email" name="email" id="email" class="form-control col-9">
            </div>
            @if ($errors->has('email'))
            <p class="text-danger container-fluid text-center"><strong>{{ $errors->first('email') }}</strong></p>
            @endif
            <div class="container-fluid d-flex justify-content-center">
                <button type="submit" class="btn btn-primary col-4" id="email_sendBtn">Send</button>
            </div>
        </form>
    </div>
</div>
@endsection
