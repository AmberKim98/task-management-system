@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/employee/editEmployee.css') }}">
<script type="text/javascript" src="{{ asset('js/employee/editEmployee.js') }}"></script>

<div class="container-fluid d-flex justify-content-center">
    <div class="card col-md-8 p-0">
        <h1 class="bg-dark display-7 text-light font-weight-bold d-flex justify-content-center p-3">Update Profile</h1>
        <div class="card-body">
        <form method="POST" action="{{ route('employee#editEmployeePost', $employee->employee_id) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end align-items-center"><label for="name" class="text-dark display-9">Name: </label></div>
                        <div class="col-md-10"><input type="text" id="name" name="name" class="form-control" value="{{ array_key_exists('name',old()) ? old('name'):$employee->employee_name }}"></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end align-items-center"><label for="email" class="text-dark display-9">Email: </label></div>
                        <div class="col-md-10"><input type="email" id="email" name="email" class="form-control" value="{{ array_key_exists('email',old()) ? old('email'):$employee->email }}"></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end align-items-center"><label for="profile" class="text-dark display-9">Profile Photo: </label></div>
                        <div class="col-md-10">
                            <div class="col-md-3"><img src="{{$employee->profile}}" height="120" id="preview_profile_img"></div>
                            <input type="file" id="profile" name="profile" class="form-control-file mt-2 col-md-9">
                            <input type="hidden" name="old_profile" value="{{ $employee->profile }}">
                        </div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('profile'))
                        <span class="text-danger">{{ $errors->first('profile') }}</span>
                    @endif
                    </div>
                </div>
            </div> 
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end"><label for="address" class="label text-dark display-9">Address: </label></div>
                        <div class="col-md-10"><textarea id="address" name="address" class="form-control" rows="5">{{ array_key_exists('address',old()) ? old('address') : $employee->address }}</textarea></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                    </div>
                </div>
            </div> 
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end align-items-center"><label for="phone" class="label text-dark display-9">Phone: </label></div>
                        <div class="col-md-10"><input type="tel" name="phone" id="phone" class="form-control" value="{{ array_key_exists('phone',old()) ? old('phone') : $employee->phone }}"></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                    </div>
                </div> 
            </div> 
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end align-items-center"><label for="dob" class="label text-dark display-9">Date of Birth: </label></div>
                        <div class="col-md-10"><input type="date" name="dob" id="dob" class="form-control" value="{{ array_key_exists('dob',old()) ? old('dob') : $employee->dob }}"></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('dob'))
                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                    @endif
                    </div>
                </div>
            </div> 
            @if(Auth::user()->position == '0')
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end align-items-center"><label for="dob" class="label text-dark display-9">Position: </label></div>
                        <div class="col-md-10">
                            <select class="form-control" id="position" name="position">
                                <option value={{null}}></option>
                                <option value="0" {{ old('position',$employee->position) == 0 ? 'selected':'' }}>Admin</option>
                                <option value="1" {{ old('position',$employee->position) == 1 ? 'selected':'' }}>Member</option>
                            </select>
                        </div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('position'))
                        <span class="text-danger">{{ $errors->first('position') }}</span>
                    @endif
                    </div>
                </div>
            </div> 
            @endif
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end pr-0">
                            <label for="password-chk" class="label text-dark display-9">Change Password?</label>
                        </div>
                        <div class="col-md-10 d-flex justify-content-start">
                            <div class="container d-flex align-items-center">
                                <div class="pr-3">
                                    <label for="yes-chk">Yes</label>
                                    <input type="radio" name="pwd_radio" class="radio" value="1" {{ old('pwd_radio') == "1" ? 'checked='.'"'.'checked'.'"':'' }} id="yes-radio" style="position:relative; top:3px;">
                                </div>
                                <div>
                                    <label for="no-chk">No</label>
                                    <input type="radio" name="pwd_radio" class="radio" value="0" {{ old('pwd_radio') == "0" ? 'checked='.'"'.'checked'.'"':'' }} id="no-radio" style="position:relative; top:3px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" id="changePasswordForm">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end"><label for="pwd" class="label text-dark display-9">Old Password: </label></div>
                        <div class="col-md-10"><input type="password" name="old_password" id="oldPwd" class="form-control" value=""></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                        @if ($errors->has('old_password'))
                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end"><label for="pwd" class="label text-dark display-9">New Password: </label></div>
                        <div class="col-md-10"><input type="password" name="new_password" id="newPwd" class="form-control" value=""></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                        @if ($errors->has('new_password'))
                            <span class="text-danger">{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="container-fluid d-flex align-items-center">
                        <div class="col-md-2 d-flex justify-content-end"><label for="pwd" class="label text-dark display-9">Confirm Password: </label></div>
                        <div class="col-md-10"><input type="password" name="new_password_confirmation" id="confirmPwd" class="form-control" value=""></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                        @if ($errors->has('new_password_confirmation'))
                            <span class="text-danger">{{ $errors->first('new_password_confirmation') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="container d-inline-flex justify-content-end">
                <button type="submit" value="submit" id="submitBtn" class="btn col-md-2 btn-outline-primary mr-2">Save</button>
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
var channel = pusher.subscribe('employee-updated');

// Bind a function to a Event (the full Laravel class)
channel.bind('employee-updated', function(data) {
  notifications.html("<li>"+data.message+"</li>");
});
</script>

@endsection