@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/project/editProject.css') }}">
<script type="text/javascript" src="{{ asset('js/task/resetTask.js') }}"></script>

<div class="container-fluid d-flex justify-content-center mb-5">
    <div class="card col-md-8 p-0">
        <h1 class="bg-dark display-7 text-light font-weight-bold d-flex justify-content-center p-3">Edit Task</h1>
        <div class="card-body offset-md-2">
        <form method="POST" action="{{ route('task#editTaskPost', $task->task_id) }}">
            @csrf

            @if (count($errors) != 0)
                <input type="hidden" value="1" id="validation-error" />
            @endif

            <input type="hidden" value="{{ $task->employee->position }}" id="position"/>
            <div class="form-group">
                <div class="col-md-3"><label for="project_name" class="text-dark display-9">Project Name: </label></div>
                <div class="col-md-9">
                    <select class="form-control" id="project_name" name="project_name" autofocus {{ (Auth::check() && Auth::user()->position != 0) ? 'disabled' : '' }}>
                        <option value="{{array_key_exists('project_name',old())? old('project_id') :$task->project->project_id}}" {{((int)old('project_name') == 'project_id') ? 'selected' : ''}}  >{{$task->project->project_name}}</option>
                        @foreach ($projects as $project)    
                            @if($project->project_name == $task->project->project_name) 
                                @continue 
                            @endif
                            <option value="{{$project->project_id}}" {{((int)old('project_name') == $project->project_id) ? 'selected' : ''}}>{{$project->project_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="container-fluid col-md-8 d-flex justify-content-start">
                    @if ($errors->has('project_name'))
                        <span class="text-danger pl-5">{{ $errors->first('project_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"><label for="title" class="text-dark display-9">Title: </label></div>
                <div class="col-md-9"><input type="text" id="title" name="title" class="form-control" value="{{ array_key_exists('title',old()) ? old('title'):$task->task_title }}" autofocus {{ (Auth::check() && Auth::user()->position != 0) ? 'disabled' : '' }}></div>
                <div class="container-fluid col-md-8 d-flex justify-content-start">
                    @if ($errors->has('title'))
                        <span class="text-danger pl-5">{{ $errors->first('title') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"><label for="description" class="text-dark display-9">Description: </label></div>
                <div class="col-md-9"><textarea id="description" name="description" class="form-control" rows="5" autofocus {{ (Auth::check() && Auth::user()->position != 0) ? 'disabled' : '' }}>{{ array_key_exists('description',old()) ? old('description') : $task->description }}</textarea></div>
                <div class="container-fluid col-md-8 d-flex justify-content-start">
                    @if ($errors->has('description'))
                        <span class="text-danger pl-5">{{ $errors->first('description') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"><label for="assigned_member" class="text-dark display-9">Assigned Employee:</label></div>
                <div class="col-md-9">
                    <select class="form-control" id="assigned_member" name="assignee_name" autofocus {{ (Auth::check() && Auth::user()->position != 0) ? 'disabled' : '' }}>
                        <option value="{{array_key_exists('assignee_name',old())? old('employee_id') :$task->employee->employee_id}}" {{((int)old('employee_name') == 'employee_id') ? 'selected' : ''}}  >{{$task->employee->employee_name}}</option>
                        @foreach ($employees as $employee)    
                            @if($employee->employee_name == $task->employee->employee_name) 
                                @continue 
                            @endif
                            <option value="{{$employee->employee_id}}" {{((int)old('assignee_name') == $employee->employee_id) ? 'selected' : ''}}>{{$employee->employee_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="container-fluid col-md-8 d-flex justify-content-start">
                    @if ($errors->has('assignee_name'))
                        <span class="text-danger pl-5">{{ $errors->first('assignee_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"><label for="estimate_hr" class="text-dark display-9">Estimate Hr:</label></div>
                <div class="col-md-9">
                    <input type="text" id="estimate_hr" name="estimate_hr" class="form-control" value="{{ array_key_exists('estimate_hr',old()) ? old('estimate_hr'):$task->estimate_hr }}" autofocus {{ (Auth::check() && Auth::user()->position != 0) ? 'disabled' : '' }}>
                </div>
                <div class="container-fluid col-md-8 d-flex justify-content-start">
                    @if ($errors->has('estimate_hr'))
                        <span class="text-danger pl-5">{{ $errors->first('estimate_hr') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"><label for="estimate_start_date_time" class="text-dark display-9">Estimate_Start_Date_Time: </label></div>
                @php 
                    $estimate_start_date_time = date('Y-m-d\TH:i', strtotime($task->estimate_start_date));
                @endphp
                <div class="col-md-9">
                    <input type="datetime-local" id="estimate_start_date_time" name="estimate_start_date_time" class="form-control" value="{{ array_key_exists('estimate_start_date_time',old()) ? old('estimate_start_date_time'): $estimate_start_date_time }}" autofocus {{ (Auth::check() && Auth::user()->position != 0) ? 'disabled' : '' }}>
                </div>
            </div>
            <div class="container-fluid col-md-8 d-flex justify-content-start">
                @if ($errors->has('estimate_start_date_time'))
                    <span class="text-danger">{{ $errors->first('estimate_start_date_time') }}</span>
                @endif
            </div>
            <div class="form-group">
                <div class="col-md-3"><label for="estimate_finish_date_time" class="text-dark display-9">Estimate_Finish_Date_Time: </label></div>
                @php 
                    $estimate_finish_date_time = date('Y-m-d\TH:i', strtotime($task->estimate_finish_date));
                @endphp
                <div class="col-md-9">
                    <input type="datetime-local" id="estimate_start_date_time" name="estimate_finish_date_time" class="form-control" value="{{ array_key_exists('estimate_finish_date_time',old()) ? old('estimate_finish_date_time'): $estimate_finish_date_time }}" autofocus {{ (Auth::check() && Auth::user()->position != 0) ? 'disabled' : '' }}>
                </div>
                <div class="container-fluid col-md-8 offset-md-2 d-flex justify-content-start">
                    @if ($errors->has('estimate_finish_date_time'))
                        <span class="text-danger">{{ $errors->first('estimate_finish_date_time') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"><label for="actual_hr" class="text-dark display-9">Actual Hr: </label></div>
                <div class="col-md-9">
                    <input type="text" id="actual_hr" name="actual_hr" class="form-control" value="{{ array_key_exists('actual_hr',old()) ? old('actual_hr'):$task->actual_hr }}" autofocus>
                </div>
                <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('actual_hr'))
                        <span class="text-danger pl-5">{{ $errors->first('actual_hr') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"><label for="actual_hr" class="text-dark display-9">Actual Hr: </label></div>
                <div class="col-md-9">
                    <input type="text" id="actual_hr" name="actual_hr" class="form-control" value="{{ array_key_exists('actual_hr',old()) ? old('actual_hr'):$task->actual_hr }}" autofocus>
                </div>
                <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('actual_hr'))
                        <span class="text-danger pl-5">{{ $errors->first('actual_hr') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"><label for="status" class="text-dark display-9">Status: </label></div>
                <div class="col-md-9">
                    <select class="form-control" id="status" name="status" autofocus>
                        <option value={{null}}></option>
                        <option value="0" {{old('status', strval($task->status)) == "0" ? 'selected': ''}}>Open</option>
                        <option value="1" {{old('status', strval($task->status)) == "1" ? 'selected': ''}} >In Progress</option>
                        <option value="2" {{old('status', strval($task->status)) == "2" ? 'selected': ''}} >Finish</option>
                        <option value="3" {{old('status', strval($task->status)) == "3" ? 'selected': ''}} >Close</option>
                    </select>
                </div>
                <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('status'))
                        <span class="text-danger pl-5">{{ $errors->first('status') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"><label for="actual_start_date_time" class="text-dark display-9">Actual_Start_Date: </label></div>
                @php 
                    $actual_start_date_time = date('Y-m-d\TH:i', strtotime($task->actual_start_date));
                @endphp
                <div class="col-md-9">
                    <input type="datetime-local" id="actual_start_date_time" name="actual_start_date_time" class="form-control" value="{{ array_key_exists('actual_start_date_time',old()) ? old('actual_start_date_time'):$actual_start_date_time }}" autofocus>
                </div>
                <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('actual_start_date_time'))
                        <span class="text-danger pl-5">{{ $errors->first('actual_start_date_time') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"><label for="actual_finish_date_time" class="text-dark display-9">Actual_Finish_Date: </label></div>
                @php 
                    $actual_finish_date_time = date('Y-m-d\TH:i', strtotime($task->actual_finish_date));
                @endphp
                <div class="col-md-9">
                    <input type="datetime-local" id="actual_finish_date_time" name="actual_finish_date_time" class="form-control" value="{{ array_key_exists('actual_finish_date_time',old()) ? old('actual_finish_date_time'):$actual_finish_date_time }}" autofocus>
                </div>
                <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('actual_finish_date_time'))
                        <span class="text-danger pl-5">{{ $errors->first('actual_finish_date_time') }}</span>
                    @endif
                </div>
            </div> 
            <div class="d-flex justify-content-center">
                <div class="col-md-5 d-flex justify-content-end"><button type="submit" value="submit" id="submitBtn" class="col-md-6 btn btn-outline-primary">Update</button></div>
                <div class="col-md-5"><button type="reset" value="reset" id="resetBtn" class="col-md-6 btn btn-outline-danger">Cancel</button></div>
            </div>
    </div>
</div>
@endsection
