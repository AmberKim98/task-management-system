@extends('layouts.app')

@section('content')
<script type="text/javascript" src="{{ asset('js/task/resetTask.js') }}"></script>

<div class="container-fluid d-flex justify-content-center">
    <div class="card col-md-8 p-0">
        <h1 class="bg-dark display-7 text-light font-weight-bold d-flex justify-content-center p-3">Create New Task</h1>
        <div class="card-body">
            <form method="POST" action="{{ route('task#createTaskPost') }}">
                @csrf
                <div class="container-fluid">
                    <div class="form-group form-inline">
                        <label for="project_name" class="justify-content-left text-dark display-8 col-md-4">Project Name: </label>
                        <select class="form-control" id="project_name" name="project_name" required autofocus>
                            <option value={{null}}></option>
                            @foreach($tasks as $task)
                                <option value="{{ $task->project_id }}" {{old('project_name') == $task->project_id ? 'selected' : ''}}>{{ $task->project_name }}</option>
                            @endforeach
                        </select>
                        <div class="container-fluid col-md-8 d-flex justify-content-center">
                            @if ($errors->has('project_name'))
                                <span class="text-danger">{{ $errors->first('project_name') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="form-group form-inline">
                        <label for="title" class="justify-content-left text-dark display-8 col-md-4">Title: </label>
                        <input type="text" id="title" name="title" class="form-control col-md-8" value="{{ old('title') }}" required autofocus>
                        <div class="container-fluid col-md-8 d-flex justify-content-center">
                            @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="form-group form-inline">
                        <label for="description" class="label text-dark display-8 col-md-4">Description: </label>
                        <textarea id="description" name="description" class="form-control col-md-8" rows="5" required autofocus>{{ old('description') }}</textarea>
                        <div class="container-fluid col-md-8 d-flex justify-content-center">
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                </div> 
                <div class="container-fluid">
                    <div class="form-group form-inline">
                        <label for="assigned_employee" class="justify-content-left text-dark display-8 col-md-4">Assigned Employee: </label>
                        <select class="form-control" id="assigned_employee" name="assigned_employee" required>
                            <option value={{null}}></option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->employee_id }}" {{old('assigned_employee') == $employee->employee_id ? 'selected' : ''}}>{{ $employee->employee_name }}</option>
                            @endforeach
                        </select>
                        <div class="container-fluid col-md-8 d-flex justify-content-center">
                            @if ($errors->has('assigned_employee'))
                                <span class="text-danger">{{ $errors->first('assigned_employee') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="form-group form-inline">
                        <label for="estimate_hr" class="justify-content-left text-dark display-8 col-md-4">Estimate_hr: </label>
                        <input type="text" id="estimate_hr" name="estimate_hr" class="form-control col-md-8" value="{{ old('estimate_hr') }}" required autofocus>
                        <div class="container-fluid col-md-8 d-flex justify-content-center">
                            @if ($errors->has('estimate_hr'))
                                <span class="text-danger">{{ $errors->first('estimate_hr') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="form-group form-inline">
                        <label for="estimate_start_date_time" class="justify-content-left text-dark display-8 col-md-4">Estimate_start_date_time: </label>
                        <input type="datetime-local" id="estimate_start_date_time" name="estimate_start_date_time" class="form-control col-md-8" value="{{ old('estimate_start_date_time') }}" placeholder="Y-m-d H:i:s" required autofocus>
                        <div class="container-fluid col-md-8 d-flex justify-content-end">
                            @if ($errors->has('estimate_start_date_time'))
                                <span class="text-danger">{{ $errors->first('estimate_start_date_time') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="form-group form-inline">
                        <label for="estimate_finish_date_time" class="justify-content-left text-dark display-8 col-md-4">Estimate_finish_date_time: </label>
                        <input type="datetime-local" id="estimate_finish_date_time" name="estimate_finish_date_time" class="form-control col-md-8" value="{{ old('estimate_finish_date_time') }}" placeholder="Y-m-d H:i:s" required autofocus>
                        <div class="container-fluid col-md-8 d-flex justify-content-end">
                            @if ($errors->has('estimate_finish_date_time'))
                                <span class="text-danger">{{ $errors->first('estimate_finish_date_time') }}</span>
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
