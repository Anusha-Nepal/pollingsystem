<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminDashboardController;




Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/verify-email/{token}', [VerificationController::class,'verifyEmail'])->name('verify.email');

Route::get('/polls/{id}', [PollController::class, 'show'])->name('poll.show')->middleware('auth');;
Route::put('/polls/{id}/update', [PollController::class, 'update'])->name('poll.update')->middleware('auth');

Route::get('/poll/create', [PollController::class, 'create'])->name('poll.create')->middleware('auth');
Route::post('/poll/create', [PollController::class, 'store'])->name('poll.create')->middleware('auth');

Route::get('/polls/{pollId}/choices/create', [ChoiceController::class, 'create'])->name('choice.create')->middleware('auth');
Route::post('/polls/{pollId}/choices/store', [ChoiceController::class, 'store'])->name('choice.store')->middleware('auth');

Route::get('/poll', [PollController::class, 'index'])->name('poll.index')->middleware('auth');

Route::delete('/poll/{id}', [PollController::class, 'delete'])->name('poll.delete')->middleware('auth');

Route::get('/polls/{id}/edit', [PollController::class, 'edit'])->name('poll.edit')->middleware('auth');

Route::get('/poll/{pollId}/vote', [VoteController::class, 'showVoteForm'])->name('vote.form')->middleware('auth');;
Route::post('/poll/{pollId}/vote', [VoteController::class, 'submitVote'])->name('vote.submit')->middleware('auth');;
Route::get('/admin/poll/{id}/results', [VoteController::class, 'showAllPollResults'])->middleware('auth');;

Route::get('/admin/poll/{pollId}/results', 'PollController@results')->name('admin.poll.results')->middleware('auth');;

Route::post('/polls/{id}/choices/store', [ChoiceController::class, 'store'])->name('choice.store')->middleware('auth');

Route::post('/poll/store', [PollController::class, 'store'])->name('poll.store')->middleware('auth');
Route::get('/search', [PollController::class, 'search'])->name('poll.search');
Route::get('/poll/create', [PollController::class, 'create'])->name('poll.create')->middleware('auth');

Route::match(['get', 'delete'], '/poll/{id}', [PollController::class, 'delete'])->name('poll.delete');


Route::get('/polls/{id}', 'PollController@show')->name('poll.show');

Route::get('/dashboard/voted-polls', [DashboardController::class, 'votedPolls'])->name('dashboard.voted-polls');

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    

    // Route::delete('/admin/delete/user/{userId}', [AdminDashboardController::class, 'deleteUser'])->name('admin.delete.user');
    
    Route::post('/admin/roles/create', [AdminDashboardController::class, 'createRole'])->name('admin.create_role');
   Route::get('/admin/view_roles', [AdminDashboardController::class,'viewRoles'])->name('admin.view_roles');
    Route::get('/admin/permissions', 'AdminDashboardController@viewPermissions')->name('admin.view_permissions')->middleware(['auth', 'admin']);
    // Route::delete('/admin/delete-user/{user}', 'AdminController@deleteUser')->name('admin.deleteUser');
    // Route::delete('/admin/delete-poll/{poll}', 'AdminController@deletePoll')->name('admin.deletePoll');
    Route::get('/admin/permissions', [AdminDashboardController::class, 'viewPermissions'])->name('admin.view_permissions');
    Route::post('/admin/permissions/create', [AdminDashboardController::class, 'createPermission'])->name('admin.create_permission');
    Route::post('/admin/assign_roles', [AdminDashboardController::class, 'assignRoles'])->name('admin.assign_roles');
    Route::get('/admin/roles-permissions', [AdminDashboardController::class])->name('admin.roles_permissions');
    Route::get('/admin/users_roles', [AdminDashboardController::class])->name('admin.users_roles');
Route::post('/admin/assign_permission', [AdminDashboardController::class,'assignPermission'])->name('admin.assign_permission');

    Route::get('/logout', [AdminDashboardController::class, 'logout'])->name('admin.logout');
 });

use App\Http\Controllers\RoleController;

Route::post('/roles', [RoleController::class, 'createRole']);
Route::post('/permissions', [RoleController::class, 'createPermission']);
Route::post('/roles/{roleId}/permissions/{permissionId}', [RoleController::class, 'assignPermissionToRole']);
Route::get('/roles', [RoleController::class, 'getAllRoles']);
Route::get('/permissions', [RoleController::class, 'getAllPermissions']);
Route::get('/roles/{roleId}/permissions', [RoleController::class, 'getPermissionsForRole']);
Route::put('/roles/{roleId}', [RoleController::class, 'updateRoleName']);
Route::delete('/roles/{roleId}', [RoleController::class, 'deleteRole']);
Route::delete('/roles/{roleId}/permissions/{permissionId}', [RoleController::class, 'revokePermissionFromRole']);
