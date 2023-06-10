<?php

use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;

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

Route::get('/', [CourseController::class, 'welcome'])->name('welcome');


Route::get('courses/create', [CourseController::class, 'create'])
    ->middleware('auth', 'admin')
    ->name('courses.create');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/dashboard', [CourseController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('courses', CourseController::class)
    ->middleware(['auth'])
    ->except('store', 'destroy', 'update', 'edit', 'create');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('courses/', [CourseController::class, 'store'])->name('courses.store');
    Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit')->whereNumber('course');
    Route::patch('courses/{course}', [CourseController::class, 'update'])->name('courses.update')->whereNumber('course');
    Route::delete('courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy')->whereNumber('course');
});


Route::resource('favourites', FavouriteController::class)
    ->middleware(['auth'])
    ->except('store', 'destroy');
Route::post('favourites/{course}', [FavouriteController::class, 'store'])
    ->name('favourites.store')
    ->middleware(['auth']);
Route::delete('favourites/{course}', [FavouriteController::class, 'destroy'])
    ->name('favourites.destroy')
    ->middleware(['auth']);


Route::middleware(['auth', 'admin'])->prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::patch('{user}', [UserController::class, 'update'])->name('update');
    Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
});


Route::resource('teachers', TeacherController::class)
    ->middleware(['auth'])
    ->except('store', 'update', 'destroy');
Route::middleware(['auth', 'admin'])->prefix('teachers')->name('teachers.')->group(function () {
    Route::post('/', [TeacherController::class, 'store'])->name('store');
    Route::patch('{teacher}', [TeacherController::class, 'update'])->name('update');
    Route::delete('{teacher}', [TeacherController::class, 'destroy'])->name('destroy');
});


Route::post('courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');
Route::delete('courses/{course}/unenroll', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');


Route::resource('schedules', ScheduleController::class)
    ->middleware('auth')
    ->except('store', 'edit', 'update');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/schedules/{course}', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('schedules/{course}/edit', [\App\Http\Controllers\ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('schedules/{course}', [\App\Http\Controllers\ScheduleController::class, 'update'])->name('schedules.update');
});


Route::resource('facilities', FacilityController::class)->middleware('auth');


Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('courses.my');
Route::get('/my-courses-sort', [CourseController::class, 'myCourseSort'])->name('courses.mySort');


Route::get('welcome/sort/{field}/{order}', [CourseController::class, 'welcome'])->name('welcome.sort');
Route::get('/login-redirect', function() {
    return redirect()->route('login');
})->name('login-redirect');

Route::get('users/{user}/attended-courses', [CourseController::class, 'attendedByUser'])->name('attended-by-user');
Route::get('users/{user}/favourited-courses', [CourseController::class, 'favouritedByUser'])->name('favourited-by-user');


require __DIR__.'/auth.php';
