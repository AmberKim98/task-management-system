@extends ('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login/login_form.css') }}">

<div class="container-fluid pt-0 clearfix">
    <form method="GET" action="">
    <div class="col-md-5 clearfix float-left mb-3">
        <div class="container-fluid col-md-5 d-flex align-items-center clearfix float-left">
            <div class="col-md-7 d-flex justify-content-end"><label for="project_id" class="text-dark display-9" style="position:relative; top:7px;">Employee ID: </label></div>
            <div class="col-md-5 d-flex justify-content-end"><input type="text" id="project_id" name="employee_id" class="form-control" value="{{ app('request')->input('employee_id') }}"></div>
        </div>
        <div class="container-fluid col-md-7 d-flex">
            <div class="col-md-6 d-flex justify-content-end"><label for="project_name" class="text-dark display-9" style="position:relative; top:12px;">Employee Name: </label></div>
            <div class="col-md-6 d-flex justify-content-end"><input type="text" id="project_name" name="employee_name" class="form-control" value="{{ app('request')->input('employee_name') }}"></div>
        </div>
    </div>
    <div class="col-md-7 d-flex justify-content-end clearfix float-left">
        <div class="container-fluid col-md-3 d-flex justify-content-end form-group offset-md-2">
            <button type="submit" id="searchBtn" class="btn btn-dark form-control">Search
                <i class="fas fa-search pl-2"></i>
            </button>
        </div>
    </form>
        <div class="container-fluid col-md-6 off-set-md-1 d-flex">
            <button type="submit" id="addEmployeeBtn" class="btn btn-primary form-control">
                <a href={{ route('add-new-employee') }} class="text-white text-decoration-none">Add New employee</a>
                <i class="fa fa-plus-circle pl-2" aria-hidden="true"></i>
            </button>
        </div>
    </div>  
</div>

<div class="container-fluid p-5">
    @if(session()->has('success'))
        <div class="alert alert-success text-center">
            {{ session()->get('success') }}
        </div>
    @endif
    <table class="emp-list-tbl table table-responsive-lg shadow-sm p-3 mb-5 bg-white rounded table-striped text-center table-hover">
        <thead class="bg-dark text-light">
            <tr>
                <th scope="col" class="align-middle">Employee ID</th>
                <th scope="col" class="align-middle">Employee Name</th>
                <th scope="col" class="align-middle">Email</th>
                <th scope="col" class="align-middle">Address</th>
                <th scope="col" class="align-middle">Phone</th>
                <th scope="col" class="align-middle">DOB</th>
                <th scope="col" class="align-middle">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <th scope="row" class="align-middle">{{ $employee->employee_id }}</th>
                <td class="align-middle">{{ $employee->employee_name }}</td>
                <td class="align-middle">{{ $employee->email }}</td>
                <td class="align-middle">{{ $employee->address }}</td>
                <td class="align-middle">{{ $employee->phone }}</td>
                <td class="align-middle">{{ $employee->dob }}</td>
                <td class="align-middle">
                   
                    <div class="container d-flex justify-content-around">
                        <a href="{{ route('employee#showEmployee', $employee->employee_id) }}" class="link text-success"><i class="fa fa-eye fa-lg text-success pr-2" aria-hidden="true"></i>Show</a>
                        <a href="{{ route('employee#editEmployee', $employee->employee_id) }}" class="link text-primary"><i class="fa fa-pencil-square fa-lg text-primary pr-2" aria-hidden="true"></i>Edit</a>

                        <button type="submit" title="delete" style="border: none; background-color:transparent;outline:none;border:0;">
                            <a href="" class="link text-danger" data-toggle="modal" data-employeeid="{{ $employee->employee_id }}" data-target="#deleteEmployee-{{ $employee->employee_id }}"><i class="fa fa-trash text-danger fa-lg pr-2" aria-hidden="true"></i>Remove</a>
                        </button>
                    </div>
                    
                    
                    <div class="modal" tabindex="-1" role="dialog" id="deleteEmployee-{{ $employee->employee_id }}">
                        <div class="modal-dialog centered" role="document">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('employee#deleteEmployee', $employee->employee_id) }}">
                                    @csrf
                                    <div class="modal-body">
                                        <h1 class="display-8 text-dark text-center pt-2">Are you sure you want to delete?</h1>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>  
            </tr>
            @endforeach
        </tbody>
    </table>

    @if(!empty($employees))
        <div class="container-fluid d-flex justify-content-center mt-5">{!! $employees->appends(Request::except('page'))->render() !!}</div>
    @endif

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
var channel = pusher.subscribe('employee-deleted');

// Bind a function to a Event (the full Laravel class)
channel.bind('employee-deleted', function(data) {
  notifications.html("<li>"+data.message+"</li>");
});
</script>

@endsection