<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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


// end

//Test front end
Route::get('/klasifikasi/jenis', function () {
return view('klasifikasi.jenis');
});

Route::get('/klasifikasi/mapel', function () {
    return view('klasifikasi.mapel');
    });

Route::get('/klasifikasi/submapel', function () {
    return view('klasifikasi.submapel');
    });

Route::get('/klasifikasi/subkelas', function () {
    return view('klasifikasi.subkelas');
    });

Route::get('/klasifikasi/jenis/add', function () {
    return view('klasifikasi.addform.addjenis');
    });

Route::get('/klasifikasi/mapel/add', function () {
    return view('klasifikasi.addform.addmapel');
    });

Route::get('/klasifikasi/submapel/add', function () {
    return view('klasifikasi.addform.addsubmapel');
    });

Route::get('/klasifikasi/subkelas/add', function () {
    return view('klasifikasi.addform.addsubkelas');
    });


Route::get('/rak', function () {
    return view('rak.index');
    });

Route::get('/rak/add', function () {
    return view('rak.create');
    });
