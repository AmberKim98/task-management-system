@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/project/editProject.css') }}">
<script type="text/javascript" src="{{ asset('js/project/editProject.js') }}"></script>

<div class="container-fluid d-flex justify-content-center">
    <div class="card col-md-8 p-0">
        <h1 class="bg-dark display-7 text-light font-weight-bold d-flex justify-content-center p-3">Update Project</h1>
        <div class="card-body">
        <form method="POST" action="{{ route('project#editProjectPost', $project->project_id) }}">
            @csrf

            @if (count($errors) != 0)
                <input type="hidden" value="1" id="validation-error" />
            @endif

            <input type="hidden" name="project_id" value="{{ $project->project_id }}">
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end align-items-center"><label for="project_name" class="text-dark display-9">Project Name: </label></div>
                        <div class="col-md-10"><input type="text" id="project_name" name="project_name" class="form-control" value="{{ array_key_exists('project_name',old()) ? old('project_name'):$project->project_name }}"></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('project_name'))
                        <span class="text-danger">{{ $errors->first('project_name') }}</span>
                    @endif
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end align-items-center"><label for="language" class="text-dark display-9">Language: </label></div>
                        <div class="col-md-10"><input type="text" id="language" name="language" class="form-control" value="{{ array_key_exists('language',old()) ? old('language'):$project->language }}"></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('language'))
                        <span class="text-danger">{{ $errors->first('language') }}</span>
                    @endif
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end"><label for="description" class="label text-dark display-9">Description: </label></div>
                        <div class="col-md-10"><textarea id="description" name="description" class="form-control" rows="5">{{ array_key_exists('description',old()) ? old('description') : $project->description }}</textarea></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                    </div>
                </div>
            </div> 
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end align-items-center"><label for="start_date" class="label text-dark display-9">Start Date: </label></div>
                        <div class="col-md-10"><input type="date" name="start_date" id="start_date" class="form-control" value="{{ array_key_exists('start_date',old()) ? old('start_date') : $project->start_date }}"></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('start_date'))
                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                    @endif
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                    <div class="container-fluid d-flex">
                        <div class="col-md-2 d-flex justify-content-end align-items-center"><label for="end_date" class="label text-dark display-9">End Date: </label></div>
                        <div class="col-md-10"><input type="date" name="end_date" id="end_date" class="form-control" value="{{ array_key_exists('end_date',old()) ? old('end_date') : $project->end_date }}"></div>
                    </div>
                    <div class="container-fluid col-md-8 d-flex justify-content-center">
                    @if ($errors->has('end_date'))
                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                    @endif
                    </div>
                </div>
            </div>

            <div class="container-fluid d-inline-flex justify-content-end px-5">
                <button type="submit" value="submit" id="submitBtn" class="btn col-md-3 btn-outline-primary mr-2">Update</button>
                <button type="reset" value="reset" id="resetBtn" class="btn col-md-3 btn-outline-danger mr-2">Cancel</button>
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
var channel = pusher.subscribe('project-updated');

// Bind a function to a Event (the full Laravel class)
channel.bind('project-updated', function(data) {
  notifications.html("<li>"+data.message+"</li>");
});
</script>

@endsection
