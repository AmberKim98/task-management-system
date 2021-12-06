<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <div class="container-fluid">
  <a class="navbar-brand text-light" href="#">Task Management System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <input type="hidden" name="position">
  <div class="collapse navbar-collapse justify-content-between" id="main_nav">

    {{-- <script>
      window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
    </script>

    <!-- This makes the current user's id available in javascript -->
    @if(!auth()->guest())
    <script>
        window.Laravel.userId = <?php echo auth()->user()->employee_id ?>;
    </script>
    @endif --}}

    <ul class="navbar-nav">
      @if(Auth::check() && Auth::user()->position == 0)
        <li class="nav-item dropdown mr-4"> 
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Employees</a> 
          <ul class="dropdown-menu bg-light">
            <li><a class="dropdown-item nav-link pl-2 text-dark" href="{{ route('add-new-employee') }}">Add New Employee</a></li>
            <li><a class="dropdown-item nav-link pl-2 text-dark" href="{{ route('employee#employeeList') }}">Employee List</a></li>
          </ul>
        </li>
      <li class="nav-item dropdown mr-4"> 
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Projects</a> 
        <ul class="dropdown-menu bg-light">
          <li><a class="dropdown-item nav-link pl-2 text-dark" href="{{ route('project#createProject') }}">Add New Project</a></li>
          <li><a class="dropdown-item nav-link pl-2 text-dark" href="{{ route('project#projectList')}}">Project List</a></li>
        </ul>
      </li>
      @endif
      @if(Auth::check())
      <li class="nav-item dropdown mr-4"> 
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Tasks</a> 
        <ul class="dropdown-menu bg-light">
          @if(Auth::check() && Auth::user()->position == 0)
            <li><a class="dropdown-item nav-link pl-2 text-dark" href="{{ route('task#createTask') }}">Add New Task</a></li>
          @endif
          <li><a class="dropdown-item nav-link pl-2 text-dark" href="{{ route('task#taskList') }}">Task List</a></li>
        </ul>
      </li>
      @php $employee_id = Auth::user()->employee_id; @endphp
      <li class="nav-item"><a class="nav-link" href="{{ route('employee#showEmployee', $employee_id) }}">Profile</a></li>
      @endif
    </ul>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item col-md-5 p-0"><a class="nav-link" href="#">@if(Auth::check()) {{Auth::user()->employee_name}} @endif</a></li>
      @if(Auth::check()) 
      <li class="nav-item dropdown col-md-3 p-0 dropdown-notifications">
        <a class="nav-link pl-0" href="#" data-toggle="dropdown" id="notifications">
          <i class="fas fa-bell text-light pl-2 bell-icon"></i>
          <span class="badge badge-primary badge-pill position-absolute">{{ Auth::user()->notifications->count() }}</span>
        </a>
        <ul class="dropdown-menu bg-light list-group-flush" id="notificationsMenu">
          @php 
            $noti_count = Auth::user()->notifications->count();      
          @endphp
          @if($noti_count == 0) 
            <li class="dropdown-header">No Notifications</li>
          @else
            <li class="dropdown-header">Notifications</li>
            @foreach(Auth::user()->Notifications as $notification)
              <li class="dropdown-item">{{ $notification->data['message'] }}</li>
            @endforeach
          @endif
        </ul>
      </li>
      <li class="nav-item col-md-4"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li> 
      @else
      <li class="nav-item col-md-4"><a class="nav-link" href="{{ route('login') }}">Login</a></li> 
      @endif
      
    </ul>
  </div> 
 </div> 
</nav>
