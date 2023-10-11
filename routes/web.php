<?php

use App\Models\Course;
use App\Models\Student;
use App\Models\TA;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $courses = Course::all();
        $users = User::all();
        $students = Student::all();
        $ta = TA::all();
        return view('dashboard',compact('courses','users','students','ta'));
    })->name('dashboard');
    Route::get('/course/detail/{id}',[CourseController::class,'courseDetail'])->name('dashboard.courseDetail');
    Route::get('/course/detail/work/{id}',[CourseController::class,'courseclasswork'])->name('dashboard.courseclasswork');
    Route::get('/course/detail/people/{id}',[CourseController::class,'coursePeople'])->name('dashboard.coursePeople');
    Route::post('/course/post',[CourseController::class,'AddPost'])->name('dashboard.AddPost');
    Route::post('/course/post/edit',[CourseController::class,'EditPost'])->name('dashboard.EditPost');
    Route::get('/course/post/delete/{id}',[CourseController::class,'DelPost'])->name('dashboard.DelPost');
    Route::post('/course/post/comment',[CourseController::class,'AddComment'])->name('dashboard.AddComment');
    Route::post('/course/post/comment/edit',[CourseController::class,'EditComment'])->name('dashboard.EditComment');
    Route::get('/course/post/comment/delete/{id}',[CourseController::class,'DelComment'])->name('dashboard.DelComment');
    Route::get('/showwork/{id}',[CourseController::class,'WorkStat'])->name('showwork');


    //Teacher
    Route::middleware(['auth', 'check:1'])->group(function () {
    Route::post('/course/create', [CourseController::class, 'create'])->name('dashboard.create');
    Route::post('/course/edit', [CourseController::class, 'courseEdit'])->name('dashboard.courseEdit');
    Route::post('/course/addStudent', [CourseController::class, 'Addstd'])->name('dashboard.Addstd');
    Route::post('/course/updateStudent', [CourseController::class, 'EditStd'])->name('dashboard.EditStd');
    Route::get('/course/delete/{id}',[CourseController::class,'delete'])->name('dashboard.delete');
    Route::get('/course/deleteStudent/{id}',[CourseController::class,'DelStd'])->name('dashboard.DelStd');
    Route::get('/course/homework/{id}',[CourseController::class,'homework'])->name('dashboard.homework');
    Route::post('/course/addTA', [CourseController::class, 'AddTA'])->name('dashboard.AddTA');
    Route::post('/course/updateTA', [CourseController::class, 'EditTA'])->name('dashboard.EditTA');
    Route::get('/course/deleteTA/{id}',[CourseController::class,'DelTA'])->name('dashboard.DelTA');
    Route::post('/addwork', [CourseController::class, 'addwork'])->name('course.addwork');
    Route::post('/course/updatework', [CourseController::class, 'Editwork'])->name('dashboard.Editwork');
    Route::get('/course/deletework/{id}',[CourseController::class,'Delwork'])->name('dashboard.Delwork');
    Route::post('/work/givepoint',[CourseController::class,'givepoint'])->name('givepoint');
    });
    //Student
    Route::middleware(['auth', 'check:3'])->group(function () {

    });
});
