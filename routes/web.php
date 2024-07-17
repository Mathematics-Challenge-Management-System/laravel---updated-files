<?php

use Illuminate\Support\Facades\Route;

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



use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword; 

use App\Http\Controllers\DashboardController;

 

        
            

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
// routes/web.php

use App\Http\Controllers\SchoolPerformanceController;

//Route::resource('schools-performance', SchoolsController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/schools-performance', [PageController::class, 'vr'])->name('schools-performance');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile-static', [PageController::class, 'school'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/pages/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
	Route::get('/guest', [PageController::class, 'guest'])->name('guest'); 

});
//Posts endpoint

Route::get('school', [ App\Http\Controllers\SchoolController::class, 'create'])->name('school');
Route::post('school', [ App\Http\Controllers\SchoolController::class, 'store'])->name('school.store');




Route::get('/challenge-creation', [App\Http\Controllers\ChallengeController::class, 'create'])->name('challenges.create');
Route::get('/challenge-index', [App\Http\Controllers\ChallengeController::class, 'index'])->name('challenges.index');
Route::post('/challenge-creation', [App\Http\Controllers\ChallengeController::class, 'store'])->name('challenges.store');

Route::get('/questions-uploading', [App\Http\Controllers\QuestionController::class, 'uploadForm'])->name('questions.upload.form');
Route::post('/questions-uploading', [App\Http\Controllers\QuestionController::class, 'upload'])->name('questions.upload');