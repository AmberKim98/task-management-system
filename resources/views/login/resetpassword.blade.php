@extends('layouts.standalone')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login/login_form.css') }}">

<div class="centered">
    <div class="container-fluid d-flex justify-content-center">
        <div class="card col-md-4 p-0">
            <div class="card-header display-8 bg-dark text-white d-block">Reset Password</div>
            <div class="card-body">
                <form method="POST" action="{{ route('reset.password.post') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{$token}}"/>
                    <input type="hidden" name="email" value="{{ app('request')->input('email') }}" /> 
                    <div class="form-group"> 
                        <label for="password" class="col-md-4 col-form-label text-md-left">New Password</label>
                        <div class="col">
                            <input type="password" id="password" class="form-control" name="password" required autofocus>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-left">Confirm Password</label>
                        <div class="col">
                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary col-md-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
