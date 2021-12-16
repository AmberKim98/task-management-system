<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [LoginController::class, 'home'])->name('homepage');
// Route::get('/tms', [LoginController::class, 'index'])->name('login');

// Route::get('logout',[LoginController::class, 'logout'])->name('logout');
// Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password')->middleware('prevent-back-history');
// Route::get('reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('pasword.reset')->middleware('prevent-back-history');
// Route::get('add-new-employee', [EmployeeController::class, 'showCreateEmployeeForm'])->name('add-new-employee')->middleware(['admin','login','prevent-back-history']);
// Route::get('employee-list', [EmployeeController::class, 'showEmployeeList'])->name('employee#employeeList')->middleware(['admin','login','prevent-back-history']);
// Route::get('show-employee/{employee_id}', [EmployeeController::class, 'showEmployeeProfile'])->name('employee#showEmployee')->middleware(['edit','login','prevent-back-history']);
// Route::get('edit-employee/{employee_id}', [EmployeeController::class, 'showEditProfileForm'])->name('employee#editEmployee')->middleware(['edit','login','prevent-back-history']);
// Route::get('project-list', [ProjectController::class, 'showProjectList'])->name("project#projectList")->middleware(['admin','login','prevent-back-history']);
// Route::get('edit-project/{project_id}', [ProjectController::class, 'showProjectEditForm'])->name('project#editProject')->middleware(['login','prevent-back-history']);
// Route::get('create-new-project', [ProjectController::class, 'showCreateProjectForm'])->name('project#createProject')->middleware(['login','prevent-back-history']);
// Route::get('create-new-task', [TaskController::class, 'showCreateTaskForm'])->name('task#createTask')->middleware(['login','prevent-back-history']);
// Route::get('edit-task/{task_id}', [TaskController::class, 'showEditTaskForm'])->name('task#editTask')->middleware(['login','prevent-back-history']);
// Route::get('task-list', [TaskController::class, 'showTaskList'])->name("task#taskList");
// Route::get('/notifications', [EmployeeController::class, 'notifications'])->name("employee#notifications");
// Route::get('tasklist-download', [TaskController::class, 'downloadTaskList'])->name('task#downloadTask');

// Route::post('/login-validation', [LoginController::class, 'loginValidate'])->name('login-validation');

// Route::post('forgot-password', [ForgotPasswordController::class, 'submitForgotPasswordForm'])->name('forgot.password.post')->middleware('prevent-back-history'); 
// Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post')->middleware('prevent-back-history');
// Route::post('add-new-employee', [EmployeeController::class, 'submitCreateEmployeeForm'])->name('add-new-employee-post')->middleware(['admin','login','prevent-back-history']);
// Route::post('edit-employee/{employee_id}', [EmployeeController::class, 'submitEditProfileForm'])->name('employee#editEmployeePost')->middleware(['edit','login','prevent-back-history']);
// Route::post('edit-project/{project_id}', [ProjectController::class, 'submitProjectEditForm'])->name('project#editProjectPost')->middleware(['admin','login','prevent-back-history']);
// Route::post('create-new-project', [ProjectController::class, 'submitCreateProjectForm'])->name('project#createProjectPost')->middleware(['admin','login','prevent-back-history']);
// Route::post('delete-project/{project_id}', [ProjectController::class, 'deleteProject'])->name('project#deleteProject')->middleware(['admin','login','prevent-back-history']);
// Route::post('create-new-task', [TaskController::class, 'submitCreateTaskForm'])->name('task#createTaskPost')->middleware(['admin','login','prevent-back-history']);
// Route::post('edit-task/{task_id}', [TaskController::class, 'submitEditTaskForm'])->name('task#editTaskPost')->middleware(['login','prevent-back-history']);
// Route::post('delete-employee/{employee_id}', [EmployeeController::class, 'deleteEmployee'])->name('employee#deleteEmployee')->middleware(['admin','login','prevent-back-history']);

Auth::routes();

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('{any}', function(){
    return view('layouts.app');
})->where('any', '.*');
