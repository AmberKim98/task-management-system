@extends ('layouts.app')

@section('content')
<div class="container-fluid d-flex pt-0 flex-column">
    <form method="GET" action="">
        <div class="row container-fluid d-flex p-0 justify-content-center mb-3">
            <div class="col-md-3 clearfix d-flex">
                <div class="col-md-4 d-flex justify-content-end align-items-center"><label for="title">Title</label></div>
                <div class="col-md-8 d-flex justify-content-end"><input type="text" id="title" name="title" class="form-control" value={{ app('request')->input('title') }}></div>
            </div>
            <div class="col-md-3 clearfix d-flex">
                <div class="col-md-4 d-flex justify-content-end align-items-center"><label for="project_name">Project</label></div>
                <div class="col-md-8 d-flex justify-content-end"><input type="text" id="project_name" name="project_name" class="form-control" value={{ app('request')->input('project_name') }}></div>
            </div>
            <div class="col-md-4 clearfix d-flex justify-content-end">
                <div class="col-md-5 d-flex justify-content-end align-items-center"><label for="assigned_employee">Assigned Employee</label></div>
                <div class="col-md-7 d-flex justify-content-end"><input type="text" id="assigned_employee" name="assigned_employee" class="form-control" value="{{ app('request')->input('assigned_employee') }}" {{ (Auth::check() && Auth::user()->position != 0) ? 'disabled' : ''}} ></div>
            </div>
        </div>
        <div class="row container-fluid d-flex p-0 justify-content-center">
            <div class="offset-md-1 col-md-3 d-flex mb-2">
                <div class="col-md-4 d-flex justify-content-end align-items-center"><label for="status">Status</label></div>
                <div class="col-md-8 d-flex justify-content-end">
                    <select class="form-control" name="status" id="status">
                        @php 
                            $status = app('request')->input('status');
                        @endphp
                        <option value={{ null }}></option>
                        <option value="0" {{ isset($status) ? 'selected':'' }}>Open</option>
                        <option value="1" {{ (app('request')->input('status')) == 1 ? 'selected' : '' }}>In progress</option>
                        <option value="2" {{ (app('request')->input('status')) == 2 ? 'selected' : '' }}>Finish</option>
                        <option value="3" {{ (app('request')->input('status')) == 3 ? 'selected' : '' }}>Close</option>
                    </select>
                </div>
            </div>
            <div class="offset-md-2 col-md-6 container-fluid d-flex justify-content-start">
                <div class="offset-md-2 col-md-4"><button type="submit" class="btn btn-dark form-control">Search<i class="fas fa-search pl-3"></i></button></div>
                <button type="submit" class="btn btn-success form-control" formaction="{{ route('task#downloadTask') }}">Download<i class="fa fa-download pl-3" aria-hidden="true"></i></button></div>
            </div>
        </div>
    </form>
</div>
<div class="container-fluid p-5">

    @if(session()->has('success'))
        <div class="alert alert-success text-center">
            {{ session()->get('success') }}
        </div>
    @endif

    <table class="emp-list-tbl table table-responsive-lg shadow-sm mb-5 bg-white rounded table-striped text-center table-hover">
        <thead class="bg-dark text-light">
            <tr>
                <th scope="col" class="align-middle">Task ID</th>
                <th scope="col" class="align-middle">Title</th>
                <th scope="col" class="align-middle">Description</th>
                <th scope="col" class="align-middle">Project Name</th>
                <th scope="col" class="align-middle">Assigned Employee</th>
                <th scope="col" class="align-middle">Estimate Hr</th>
                <th scope="col" class="align-middle">Actual Hr</th>
                <th scope="col" class="align-middle">Status</th>
                <th scope="col" class="align-middle">Estimate Start Date</th>
                <th scope="col" class="align-middle">Estimate Finish Date</th>
                <th scope="col" class="align-middle">Actual Start Date</th>
                <th scope="col" class="align-middle">Actual Finish Date</th>
                <th scope="col" class="align-middle">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <th scope="row" class="align-middle">{{ $task->task_id }}</th>
                <td class="align-middle">{{ $task->task_title }}</td>
                <td class="align-middle">{{ $task->description }}</td>
                <td class="align-middle">{{ $task->project->project_name }}</td>
                <td class="align-middle">{{ $task->employee->employee_name }}</td>
                <td class="align-middle">{{ $task->estimate_hr }}</td>
                <td class="align-middle">{{ $task->actual_hr }}</td>
                @php 
                    $status = null;
                    switch($task->status)
                    {
                        case 0: $status = "Open";break;
                        case 1: $status = "In progress"; break;
                        case 2: $status = "Finish"; break;
                        case 3: $status = "Close"; break;
                        default: $status = "Open"; 
                    }
                    @endphp
                <td class="align-middle">{{ $status }}</td>
                <td class="align-middle">{{ $task->estimate_start_date }}</td>
                <td class="align-middle">{{ $task->estimate_finish_date }}</td>
                <td class="align-middle">{{ $task->actual_start_date }}</td>
                <td class="align-middle">{{ $task->actual_finish_date }}</td>
                <td class="align-middle">
                    <div class="container d-flex justify-content-around">
                        <a href="{{ route('task#editTask', $task->task_id) }}" class="action-link text-light"><i class="fa fa-pencil-square fa-lg text-primary pr-2" aria-hidden="true"></i>Edit</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if(!empty($tasks))
        <div class="container-fluid d-flex justify-content-center mt-5">{!! $tasks->appends(Request::except('page'))->render() !!}</div>
    @endif
</div>
@endsection