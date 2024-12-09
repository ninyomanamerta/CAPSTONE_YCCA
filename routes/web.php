<?php

use App\Http\Controllers\BookTypeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrichmentbookController;
use App\Http\Controllers\SubClassController;
use App\Http\Controllers\SubCourseController;
use App\Models\detailenrichmentbook;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookCaseController;
use App\Http\Controllers\PackageBookController;
use App\Http\Controllers\PeminjamanBukuPaketController;
use App\Http\Controllers\PeminjamanBukuPengayaanController;
use App\Http\Controllers\UserProfile;


Route::get('/', function () {
    return view('welcome');
});

// Using Controller

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Profile
Route::get('/profile', [UserProfile::class, 'edit'])->name('profile');
Route::post('/profile/update', [UserProfile::class, 'update'])->name('profile.update');
Route::delete('/profile/delete', [UserProfile::class, 'destroy'])->name('profile.delete');


// Student
Route::get('/siswa', [StudentController::class, 'index'])->name('student.index');
Route::get('/siswa/add', [StudentController::class, 'create'])->name('student.create');
Route::post('/siswa/store', [StudentController::class, 'store'])->name('student.store');
Route::get('/siswa/{id}', [StudentController::class, 'show']);
Route::get('/siswa/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/siswa/{id}', [StudentController::class, 'update'])->name('student.update');
Route::delete('/siswa/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
Route::get('/siswa/add/import/file', [StudentController::class, 'import'])->name('student.import');
Route::post('/siswa/import/file/store', [StudentController::class, 'proses'])->name('student.proses');


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
    Route::get('/jenis/{id}', [BookTypeController::class, 'show'])->name('jenis.show');
    Route::delete('/jenis/{id}', [BookTypeController::class, 'destroy'])->name('jenis.destroy');
    Route::put('/jenis/{id}', [BookTypeController::class, 'update'])->name('jenis.update');
    Route::get('/jenis/{id}/edit', [BookTypeController::class, 'edit'])->name('jenis.edit');

// Package Book

    Route::get('/paket', [PackageBookController::class, 'index'])->name('paket.index');
    Route::get('/paket/detail/{id}', [PackageBookController::class, 'detail'])->name('paket.detail');
    Route::get('/paket/add', [PackageBookController::class, 'create'])->name('paket.create');
    Route::post('/paket/store', [PackageBookController::class, 'store'])->name('paket.store');
    Route::delete('/paket/detail/{id}', [PackageBookController::class, 'destroy'])->name('paket.destroy');
    Route::put('/paket/{id}', [PackageBookController::class, 'update'])->name('paket.update');
    Route::get('/paket/{id}/edit', [PackageBookController::class, 'edit'])->name('paket.edit');
    Route::delete('/paket/destroyAll/{id}', [PackageBookController::class, 'destroyAll'])->name('paket.destroyAll');
    Route::get('/paket/bukuRusak', [PackageBookController::class, 'showDamagedBook'])->name('paket.damaged');
    Route::patch('/paket/bukuRusak/update', [PackageBookController::class, 'updateDamagedBook'])->name('paket.damagedUpdate');
    Route::patch('/paket/bukuRusak/update/status', [PackageBookController::class, 'updateStatus'])->name('paket.updateStatus');
    Route::get('/paket/showAll', [PackageBookController::class, 'showAll'])->name('paket.showAll');

    Route::get('/paket/bukuRusak/exportFile', [PackageBookController::class, 'exportFile'])->name('paket.damagedExport');




// Peminjaman Buku Paket
    Route::get('/paket/peminjaman/add', [PeminjamanBukuPaketController::class, 'create'])->name('pinjamPaket.create');
    Route::post('/paket/peminjaman/store', [PeminjamanBukuPaketController::class, 'store'])->name('pinjamPaket.store');
    Route::get('/paket/peminjaman/detail/siswa/{id}', [PeminjamanBukuPaketController::class, 'showPeminjamanByClassLevels'])->name('pinjamPaket.detail');
    Route::get('/paket/peminjaman/edit/{id}', [PeminjamanBukuPaketController::class, 'edit'])->name('pinjamPaket.edit');
    Route::put('/paket/peminjaman/edit/{id}', [PeminjamanBukuPaketController::class, 'update'])->name('pinjamPaket.update');
    Route::delete('/paket/peminjaman/delete/{id}', [PeminjamanBukuPaketController::class, 'destroyBook'])->name('pinjamPaket.destroyBook');
    Route::get('/paket/peminjaman/status/{id}', [PeminjamanBukuPaketController::class, 'status'])->name('pinjamPaket.status');
    Route::put('/paket/pinjam/status/{id}', [PeminjamanBukuPaketController::class, 'updateStatus'])->name('pinjamPaket.updateStatus');
    Route::get('/pinjamPaket/{id}', [PeminjamanBukuPaketController::class, 'show']);
    Route::get('/pinjamPaket/modal/{id}', [PeminjamanBukuPaketController::class, 'showModal']);
    Route::get('/paket/peminjaman/', [PeminjamanBukuPaketController::class, 'index'])->name('pinjamPaket.index');
    Route::delete('paket/peminjaman/siswa/{id}', [PeminjamanBukuPaketController::class, 'destroyByStudent'])->name('pinjamPaket.destroyByStudent');



// Pengayaan
    Route::get('/pengayaan', [EnrichmentbookController::class, 'index'])->name('enrichmentBooks.index');
    Route::get('/pengayaan/damagedBooks', [EnrichmentbookController::class, 'damagedBooks'])->name('enrichmentBooks.damagedBooks');
    Route::patch('/pengayaan/damagedBooks/update', [EnrichmentbookController::class, 'updateDamagedBooks'])->name('enrichmentBooks.updateDamagedBooks');
    Route::get('/pengayaan/showAll', [EnrichmentbookController::class, 'showAll'])->name('enrichmentBooks.showAll');
    Route::patch('/pengayaan/damagedBooks/update/status', [EnrichmentbookController::class, 'updateStatus'])->name('enrichmentBooks.updateStatus');


    Route::get('/pengayaan/add', [EnrichmentbookController::class, 'create'])->name('enrichmentBooks.create');
    Route::post('/pengayaan/store', [EnrichmentbookController::class, 'store'])->name('enrichmentBooks.store');
    Route::get('/pengayaan/{id}', [EnrichmentbookController::class, 'show']);
    Route::delete('/pengayaan/{id}', [EnrichmentbookController::class, 'destroy'])->name('enrichmentBooks.destroy');
    Route::put('/pengayaan/{id}', [EnrichmentbookController::class, 'update'])->name('enrichmentBooks.update');
    Route::get('/pengayaan/{id}/edit', [EnrichmentbookController::class, 'edit'])->name('enrichmentBooks.edit');
    Route::get('/pengayaan/detail/{id}', [EnrichmentbookController::class, 'detail'])->name('enrichmentBooks.detail');
    Route::delete('/pengayaan/detail/{id}', [EnrichmentbookController::class, 'destroyDetail'])->name('enrichmentBooks.destroyDetail');
    Route::delete('/pengayaan/deleteAll/{id}', [EnrichmentbookController::class, 'destroyAll'])->name('enrichmentBooks.destroyAll');

    Route::get('/pengayaan/import/file', [EnrichmentbookController::class, 'import'])->name('enrichmentBooks.import');
    Route::post('/pengayaan/import/file/store', [EnrichmentbookController::class, 'proses'])->name('enrichmentBooks.proses');






// Peminjaman Buku Pengayaan
    Route::get('/peminjamanpengayaan', [PeminjamanBukuPengayaanController::class, 'index'])->name('peminjamanbukupengayaan.index');
    Route::get('/peminajamanpengayaan/add', [PeminjamanBukuPengayaanController::class, 'create'])->name('peminjamanbukupengayaan.create');
    Route::post('/peminjamanpengayaan/store', [PeminjamanBukuPengayaanController::class, 'store'])->name('peminjamanbukupengayaan.store');
    Route::get('/get-books/{judulId}', [PeminjamanBukuPengayaanController::class, 'getBooksByJudul'])->name('get.books');
    Route::patch('/peminjamanbukupengayaan/{id}', [PeminjamanBukuPengayaanController::class, 'update'])->name('peminjamanbukupengayaan.update');
    Route::delete('/peminjamanbukupengayaan/{id}', [PeminjamanBukuPengayaanController::class, 'destroy'])->name('peminjamanbukupengayaan.destroy');





//Test front end



// Route::get('/paket', function () {
//     return view('paket.index');
//     });


// Route::get('/detailpengayaan/test', function () {
//     return view('pengayaan.test');
//     });

Route::get('/landingpage', function () {
    return view('auth.landingpage');
    });






