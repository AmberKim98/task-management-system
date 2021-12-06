@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/employee/addNewEmployee.css') }}">
<script type="text/javascript" src="{{ asset('js/employee/addNewEmployee.js') }}"></script>

<div class="container-fluid d-flex justify-content-center">
    <div class="card col-md-8 p-0">
        <h1 class="bg-dark display-7 text-light font-weight-bold d-flex justify-content-center p-3">Employee Profile</h1>
        <div class="card-body">
        <form method="POST" action="{{ route('add-new-employee-post') }}" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
                <div class="form-group form-inline">
                    <label for="name" class="justify-content-left text-dark display-8 col-md-4">Name: </label>
                    <input type="text" id="name" name="name" class="form-control col-md-8" value="{{ old('name') }}" required autofocus>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group form-inline">
                    <label for="email" class="justify-content-left text-dark display-8 col-md-4">Email: </label>
                    <input type="email" id="email" name="email" class="form-control col-md-8" value="{{ old('email') }}" required autofocus>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group form-inline">
                    <label for="profile" class="justify-content-left text-dark display-8 col-md-4">Profile Photo: </label>
                    <input type="file" id="profile" name="profile" class="form-control-file col-md-8" value="{{ old('profile') }}" required autofocus>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                        @if ($errors->has('profile'))
                            <span class="text-danger">{{ $errors->first('profile') }}</span>
                        @endif
                    </div>
                </div>
            </div> 
            <div class="container-fluid">
                <div class="form-group form-inline">
                    <label for="address" class="label text-dark display-8 col-md-4">Address: </label>
                    <textarea id="address" name="address" class="form-control col-md-8" rows="5" required autofocus>{{ old('address') }}</textarea>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                </div>
            </div> 
            <div class="container-fluid">
                <div class="form-group form-inline">
                    <label for="phone" class="label text-dark display-8 col-md-4">Phone: </label>
                    <input type="tel" name="phone" id="phone" class="form-control col-md-8" value="{{ old('phone') }}" required autofocus>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                </div> 
            </div> 
            <div class="container-fluid">
                <div class="form-group form-inline">
                    <label for="dob" class="label text-dark display-8 col-md-4">DOB: </label>
                    <input type="date" name="dob" id="dob" class="form-control col-md-8" value="{{ old('dob') }}" required autofocus>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                        @if ($errors->has('dob'))
                            <span class="text-danger">{{ $errors->first('dob') }}</span>
                        @endif
                    </div>
                </div>
            </div> 
            <div class="container-fluid">
                <div class="form-group form-inline">
                    <label for="dob" class="label text-dark display-8 col-md-4">Position: </label>
                    <select class="form-control col-md-8" id="position" name="position" required autofocus>
                        <option value={{null}}>Choose your position...</option>
                        <option value="0" {{old('position') == '0' ? 'selected':''}}>Admin</option>
                        <option value="1" {{old('position') == '1' ? 'selected':''}}>Member</option>
                    </select>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                        @if ($errors->has('position'))
                            <span class="text-danger">{{ $errors->first('position') }}</span>
                        @endif
                    </div>
                </div>
            </div> 
            <div class="container d-inline-flex justify-content-end">
                <button type="submit" value="submit" class="btn col-md-2 btn-outline-primary mr-2">Save</button>
                <button type="reset" value="reset" id="resetBtn" class="btn col-md-2 btn-outline-danger">Cancel</button>
            </div> 
        </form>
        </div>
    </div>
</div>
@endsection

@section('script')

<script src="//js.pusher.com/3.1/pusher.min.js"></script>

<script type="text/javascript">
var notificationsWrapper   = $('.dropdown-notifications');
var notifications          = notificationsWrapper.find('ul.dropdown-menu');
// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

var pusher = new Pusher('945da2f9505f99566899', {
  cluster:'ap1',
  encrypted: true
});

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('employee-created');

// Bind a function to a Event (the full Laravel class)
channel.bind('employee-created', function(data) {
  notifications.html("<li>"+data.message+"</li>");
});
</script>

@endsection