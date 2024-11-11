<?php

use App\Http\Controllers\BookTypeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubClassController;
use App\Http\Controllers\SubCourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookCaseController;



Route::get('/', function () {
    return view('welcome');
});

// Using Controller

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Student
Route::get('/siswa', [StudentController::class, 'index'])->name('student.index');
Route::get('/siswa/add', [StudentController::class, 'create'])->name('student.create');
Route::post('/siswa/store', [StudentController::class, 'store'])->name('student.store');
Route::get('/siswa/{id}', [StudentController::class, 'show']);
Route::get('/siswa/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/siswa/{id}', [StudentController::class, 'update'])->name('student.update');
Route::delete('/siswa/{id}', [StudentController::class, 'destroy'])->name('student.destroy');


// BookCase

    Route::get('/rak', [BookCaseController::class, 'index'])->name('rak.index');
    Route::get('/rak/add', [BookCaseController::class, 'create'])->name('rak.create');
    Route::post('/rak/store', [BookCaseController::class, 'store'])->name('rak.store');
    Route::get('/rak/{id}', [BookCaseController::class, 'show']);
    Route::get('/rak/{id}/edit', [BookCaseController::class, 'edit'])->name('rak.edit');
    Route::put('/rak/{id}', [BookCaseController::class, 'update'])->name('rak.update');
    Route::delete('/rak/{id}', [BookCaseController::class, 'destroy'])->name('rak.destroy');



// Course
    Route::get('/klasifikasi/mapel', [CourseController::class, 'index'])->name('course.index');
    Route::get('/klasifikasi/mapel/add', [CourseController::class, 'create'])->name('course.create');
    Route::post('/klasifikasi/mapel/store', [CourseController::class, 'store'])->name('course.store');
    Route::get('/klasifikasi/mapel/{id}', [CourseController::class, 'show']);
    Route::get('/klasifikasi/mapel/{id}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/klasifikasi/mapel/{id}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/klasifikasi/mapel/{id}', [CourseController::class, 'destroy'])->name('course.destroy');

// SubCourse
    Route::get('/klasifikasi/submapel', [SubCourseController::class, 'index'])->name('subCourse.index');
    Route::get('/klasifikasi/submapel/add', [SubCourseController::class, 'create'])->name('subCourse.create');
    Route::post('/klasifikasi/submapel/store', [SubCourseController::class, 'store'])->name('subCourse.store');
    Route::get('/klasifikasi/submapel/{id}', [SubCourseController::class, 'show']);
    Route::get('/klasifikasi/submapel/{id}/edit', [SubCourseController::class, 'edit'])->name('subCourse.edit');
    Route::put('/klasifikasi/submapel/{id}', [SubCourseController::class, 'update'])->name('subCourse.update');
    Route::delete('/klasifikasi/submapel/{id}', [SubCourseController::class, 'destroy'])->name('subCourse.destroy');

// SubClass
    Route::get('/klasifikasi/subkelas', [SubClassController::class, 'index'])->name('class.index');
    Route::get('/klasifikasi/subkelas/add', [SubClassController::class, 'create'])->name('class.create');
    Route::post('/klasifikasi/subkelas/store', [SubClassController::class, 'store'])->name('class.store');
    Route::get('/klasifikasi/subkelas/{id}', [SubClassController::class, 'show']);
    Route::get('/klasifikasi/subkelas/{id}/edit', [SubClassController::class, 'edit'])->name('class.edit');
    Route::put('/klasifikasi/subkelas/{id}', [SubClassController::class, 'update'])->name('class.update');
    Route::delete('/klasifikasi/subkelas/{id}', [SubClassController::class, 'destroy'])->name('class.destroy');


// Klasifikasi Jenis
    Route::get('/jenis', [BookTypeController::class, 'index'])->name('jenis.index');
    Route::get('/jenis/add', [BookTypeController::class, 'create'])->name('jenis.create');
    Route::post('/jenis/store', [BookTypeController::class, 'store'])->name('jenis.store');
    Route::get('/jenis/{id}', [BookTypeController::class, 'show']);
    Route::delete('/jenis/{id}', [BookTypeController::class, 'destroy'])->name('jenis.destroy');
    Route::put('/jenis/{id}', [BookTypeController::class, 'update'])->name('jenis.update');
    Route::get('/jenis/{id}/edit', [BookTypeController::class, 'edit'])->name('jenis.edit');



//Test front end
Route::get('/nonfiksi/add', function () {
   return view('nonfiksi.create');
   });
        
Route::get('/nonfiksi', function () {
   return view('nonfiksi.index');
   });          

Route::get('/paket/add', function () {
    return view('paket.create');
    });  

Route::get('/paket', function () {
    return view('paket.index');
    });  

Route::get('/paket/detail', function () {
    return view('paket.detail');
    });  
    
Route::get('/book/edit', function () {
    return view('rak.edit');
    });




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
