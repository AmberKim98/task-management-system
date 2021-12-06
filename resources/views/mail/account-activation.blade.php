@extends('layouts.standalone')

@section('content')
    <div class="container-fluid text-dark text-center">
        <h2 class="display-6">Hello, {{ $user['name'] }},</h2>
        <p class="display-8">A new user for task management system has been created for {{ $user['email'] }}<br>Your password is <b>password1234</b></p>
        <p class="display-8">Here is the link to login to the system.</p>
        <a href="{{ route('login') }}" class="info-link">
            @php 
                $env=env('APP_ENV');
            @endphp 
            <p>{{ ($env == 'local') ? env('APP_URL'):env('APP_PROD_URL') }}<span>/login</span></p>
        </a>
        <p class="display-8">Thank you!</p>
    </div>
@endsection
