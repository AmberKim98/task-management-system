@extends ('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login/login_form.css') }}">

<div class="container-fluid pt-0 clearfix">
    <form action="" method="GET">
    <div class="col-md-5 clearfix float-left mb-3">
        <div class="container-fluid col-md-7 d-flex align-items-center clearfix float-left">
            <div class="col-md-6 d-flex justify-content-end"><label for="project_name" class="text-dark display-9" style="position:relative; top:7px;">Project Name: </label></div>
            <div class="col-md-6 d-flex justify-content-end"><input type="text" id="project_name" name="project_name" class="form-control"  value="{{ app('request')->input('project_name') }}"></div>
        </div>
        <div class="container-fluid col-md-5 d-flex">
            <div class="col-md-3 d-flex justify-content-end"><label for="language" class="text-dark display-9" style="position:relative; top:12px;">Language: </label></div>
            <div class="col-md-9 d-flex justify-content-end"><input type="text" id="language" name="language" class="form-control" value="{{ app('request')->input('language') }}"></div>
        </div>
    </div>
    <div class="col-md-7 d-flex justify-content-start clearfix float-left">
        <div class="container-fluid col-md-3 d-flex justify-content-end form-group offset-md-2">
            <button type="submit" id="searchBtn" class="btn btn-dark form-control">Search
                <i class="fas fa-search pl-2"></i>
            </button>
        </div>
        <div class="container-fluid col-md-6 off-set-md-1 d-flex">
            <a id="addEmployeeBtn" href="{{route('project#createProject')}}" class="btn btn-primary form-control">
                Create New Project
                <i class="fa fa-plus-circle pl-2" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    </form>
</div>
<div class="container-fluid px-5 pt-5">
    <table class="emp-list-tbl table table-responsive-lg shadow-sm p-3 mb-5 bg-white rounded table-striped text-center table-hover">
        <thead class="thead-dark text-light">
            <tr>
                <th scope="col" class="col-md-1 align-middle">Project ID</th>
                <th scope="col" class="col-md-2 align-middle">Project Name</th>
                <th scope="col" class="col-md-1 align-middle">Language</th>
                <th scope="col" class="col-md-4 align-middle">Description</th>
                <th scope="col" class="col-md-1 align-middle">Start Date</th>
                <th scope="col" class="col-md-1 align-middle">End Date</th>
                <th scope="col" class="col-md-3 align-middle">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <th scope="row" class="align-middle">{{ $project->project_id }}</th>
                <td class="align-middle">{{ $project->project_name }}</td>
                <td class="align-middle">{{ $project->language }}</td>
                <td class="text-center">{{ $project->description }}</td>
                <td class="align-middle">{{ $project->start_date }}</td>
                <td class="align-middle">{{ $project->end_date }}</td>
                <td class="align-middle">
                    <div class="container d-flex justify-content-around">
                        <a href="{{ route('project#editProject', $project->project_id) }}" class="link text-primary"><i class="fa fa-pencil-square fa-lg text-primary pr-2" aria-hidden="true"></i>Edit</a>

                        <button type="submit" title="delete" style="border: none; background-color:transparent;outline:none;border:0;">
                            <a href="" class="link text-danger" data-toggle="modal" data-projectid="{{ $project->project_id }}" data-target="#deleteProject-{{ $project->project_id }}"><i class="fa fa-trash text-danger fa-lg pr-2" aria-hidden="true"></i>Remove</a>
                        </button>
                    </div>

                    <div class="modal" id="deleteProject-{{ $project->project_id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog centered" role="document">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('project#deleteProject', $project->project_id) }}">
                                @csrf
                                    <div class="modal-body">
                                        <h1 class="display-8 text-dark text-center pt-2">Are you sure you want to delete?</h1>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
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

    @if(!empty($projects))
        <div class="container-fluid d-flex justify-content-center mt-5">{!! $projects->appends(Request::except('page'))->render() !!}</div>
    @endif
</div>
@endsection
