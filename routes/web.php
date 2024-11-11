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
Route::delete('/rak/{id}', [BookCaseController::class, 'destroy'])->name('rak.destroy');

// Klasifikasi Jenis
Route::get('/jenis', [BookTypeController::class, 'index'])->name('jenis.index');
Route::get('/jenis/add', [BookTypeController::class, 'create'])->name('jenis.create');
Route::post('/jenis/store', [BookTypeController::class, 'store'])->name('jenis.store');
Route::get('/jenis/{id}', [BookTypeController::class, 'show']);
Route::delete('/jenis/{id}', [BookTypeController::class, 'destroy'])->name('jenis.destroy');
Route::put('/jenis/{id}', [BookTypeController::class, 'update'])->name('jenis.update');
Route::get('/jenis/{id}/edit', [BookTypeController::class, 'edit'])->name('jenis.edit');

// Klasifikasi Mata Pelajaran
Route::get('/klasifikasi/mapel', [CourseController::class, 'index'])->name('mapel.index');
Route::get('/klasifikasi/mapel/add', [CourseController::class, 'create'])->name('mapel.create');

// Klasifikasi Sub Mata Pelajaran
route::get('/klasifikasi/submapel', [SubCourseController::class, 'index'])->name('submapel.index');

// Klasifikasi Sub Kelas
Route::get('/klasifikasi/subkelas', [SubClassController::class, 'index'])->name('subkelas.index');
// end

//Test front end


Route::get('/klasifikasi/mapel/add', function () {
    return view('klasifikasi.addform.addmapel');
});

Route::get('/klasifikasi/submapel/add', function () {
    return view('klasifikasi.addform.addsubmapel');
});

Route::get('/klasifikasi/subkelas/add', function () {
    return view('klasifikasi.addform.addsubkelas');
});

Route::get('/book/edit', function () {
    return view('rak.edit');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
