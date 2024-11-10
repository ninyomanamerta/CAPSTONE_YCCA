<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookCaseController;
use App\Http\Controllers\BookTypeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubCourseController;

Route::get('/', function () {
    return view('welcome');
});

// Using Controller

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


// BookType
    Route::get('/klasifikasi/jenis', [BookTypeController::class, 'index'])->name('bookType.index');
    Route::get('/klasifikasi/jenis/add', [BookTypeController::class, 'create'])->name('bookType.create');


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



// end

//Test front end


Route::get('/klasifikasi/subkelas', function () {
    return view('klasifikasi.subkelas');
    });

// Route::get('/klasifikasi/jenis/add', function () {
//     return view('klasifikasi.addform.addjenis');
//     });


Route::get('/klasifikasi/subkelas/add', function () {
    return view('klasifikasi.addform.addsubkelas');
    });



