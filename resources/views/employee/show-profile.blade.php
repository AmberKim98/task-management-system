@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/employee/editEmployee.css') }}">
<script type="text/javascript" src="{{ asset('js/employee/editEmployee.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/employee/showEmployee.js') }}"></script>

<div class="container-fluid d-flex justify-content-center">
    <div class="card col-md-6 p-0">
        <h1 class="bg-dark display-7 text-light font-weight-bold d-flex justify-content-center p-3">Employee Profile</h1>
        <div class="card-body">
        <form method="" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="employee_id" id="employeeID" value="{{ $employee->employee_id }}">
            <input type="hidden" id="userID" value="{{ Auth()->user()->employee_id }}">

            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-5 d-flex justify-content-end align-items-center"><label for="name" class="text-dark display-9">Name: </label></div>
                        <div class="col-md-7"><label class="text-dark display-9 font-weight-bold">{{ $employee->employee_name }}</label></div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-5 d-flex justify-content-end align-items-center"><label for="email" class="text-dark display-9">Email: </label></div>
                        <div class="col-md-7"><label class="text-dark display-9 font-weight-bold">{{ $employee->email }}</label></div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-5 d-flex justify-content-end align-items-center"><label for="profile" class="text-dark display-9">Profile Photo: </label></div>
                        <div class="col-md-7"><label><img src="{{ $employee->profile }}" height="120" id="preview_profile_img"></label></div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-5 d-flex justify-content-end align-items-center"><label for="address" class="text-dark display-9">Address: </label></div>
                        <div class="col-md-7"><label class="text-dark display-9 font-weight-bold">{{ $employee->address }}</label></div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-5 d-flex justify-content-end align-items-center"><label for="phone" class="text-dark display-9">Phone: </label></div>
                        <div class="col-md-7"><label class="text-dark display-9 font-weight-bold">{{ $employee->phone }}</label></div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-5 d-flex justify-content-end align-items-center"><label for="dob" class="text-dark display-9">Date of Birth: </label></div>
                        <div class="col-md-7"><label class="text-dark display-9 font-weight-bold">{{ $employee->dob }}</label></div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-5 d-flex justify-content-end align-items-center"><label for="position" class="text-dark display-9">Position: </label></div>
                        <div class="col-md-7"><label class="text-dark display-9 font-weight-bold" id="position">{{ ($employee->position == 1? 'member':'admin') }}</label></div>
                    </div>
                </div>
            </div>

            <div class="container-fluid d-flex">
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ route('employee#editEmployee', $employee->employee_id) }}" class="btn col-md-5 btn-outline-success disabled" role="button" id="editBtn">Edit</a>
                </div>
                <div class="col-md-6">
                    <a href="{{ (Auth()->user()->position == 0) ? route('employee#employeeList') : route('task#taskList')}}" class="btn col-md-5 btn-outline-primary" role="button" id="backBtn">Back</a>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
