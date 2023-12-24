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
Route::post('/register', [AuthController::class, 'register']);


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/polls/{id}', [PollController::class, 'show'])->name('poll.show');
Route::put('/polls/{id}/update', [PollController::class, 'update'])->name('poll.update');

Route::get('/poll/create', [PollController::class, 'create'])->name('poll.create');
Route::post('/poll/create', [PollController::class, 'store']);



Route::post('/polls/{pollId}/vote', [VoteController::class, 'vote'])->name('poll.vote');


Route::get('/polls/{pollId}/choices/create', [ChoiceController::class, 'create'])->name('choice.create');
Route::post('/polls/{pollId}/choices/store', [ChoiceController::class, 'store'])->name('choice.store');

Route::get('/poll', [PollController::class, 'index'])->name('poll.index');

Route::delete('/poll/{id}', [PollController::class, 'delete'])->name('poll.delete');

Route::get('/polls/{id}/edit', [PollController::class, 'edit'])->name('poll.edit');

Route::get('/polls/{pollId}/choices', [ChoiceController::class, 'index'])->name('choice.index');

Route::post('/polls/{pollId}/choices/store', [ChoiceController::class, 'store'])->name('choice.store');

Route::post('/poll/store', [PollController::class, 'store'])->name('poll.store');


Route::match(['get', 'delete'], '/poll/{id}', [PollController::class, 'delete'])->name('your.route.name');
Route::get('/verifyemail/{token}', [VerificationController::class, 'verifyEmail'])->name('verify.email');


Route::middleware(['auth:admin', 'can:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
   });
