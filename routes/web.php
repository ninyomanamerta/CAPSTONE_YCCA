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
use App\Http\Controllers\SubClasificationController;
use App\Http\Controllers\SubClasificationThController;
use App\Http\Controllers\ExportController;


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
    Route::get('/klasifikasi/subI', [SubCourseController::class, 'index'])->name('subCourse.index');
    Route::get('/klasifikasi/subI/add', [SubCourseController::class, 'create'])->name('subCourse.create');
    Route::post('/klasifikasi/subI/store', [SubCourseController::class, 'store'])->name('subCourse.store');
    Route::get('/klasifikasi/submapel/{id}', [SubCourseController::class, 'show']);
    Route::get('/klasifikasi/subI/{id}/edit', [SubCourseController::class, 'edit'])->name('subCourse.edit');
    Route::put('/klasifikasi/subI/{id}', [SubCourseController::class, 'update'])->name('subCourse.update');
    Route::delete('/klasifikasi/subI/{id}', [SubCourseController::class, 'destroy'])->name('subCourse.destroy');

// SubClass
    Route::get('/klasifikasi/subII', [SubClassController::class, 'index'])->name('class.index');
    Route::get('/klasifikasi/subII/add', [SubClassController::class, 'create'])->name('class.create');
    Route::post('/klasifikasi/subII/store', [SubClassController::class, 'store'])->name('class.store');
    Route::get('/klasifikasi/subkelas/{id}', [SubClassController::class, 'show']);
    Route::get('/klasifikasi/subII/{id}/edit', [SubClassController::class, 'edit'])->name('class.edit');
    Route::put('/klasifikasi/subII/{id}', [SubClassController::class, 'update'])->name('class.update');
    Route::delete('/klasifikasi/subII/{id}', [SubClassController::class, 'destroy'])->name('class.destroy');

// Sub Klasifikasi (III)
    Route::get('/klasifikasi/subIII', [SubClasificationController::class, 'index'])->name('klasifikasi.index');
    Route::get('/klasifikasi/subIII/add', [SubClasificationController::class, 'create'])->name('klasifikasi.create');
    Route::post('/klasifikasi/subIII/store', [SubClasificationController::class, 'store'])->name('klasifikasi.store');
    Route::get('/klasifikasi/subklasifikasi/{id}', [SubClasificationController::class, 'show']);
    Route::get('/klasifikasi/subIII/{id}/edit', [SubClasificationController::class, 'edit'])->name('klasifikasi.edit');
    Route::put('/klasifikasi/subIII/{id}', [SubClasificationController::class, 'update'])->name('klasifikasi.update');
    Route::delete('/klasifikasi/subIII/{id}', [SubClasificationController::class, 'destroy'])->name('klasifikasi.destroy');

// Sub Klasifikasi (IV)
    Route::get('/klasifikasi/subIV', [SubClasificationThController::class, 'index'])->name('klasifikasiTh.index');
    Route::get('/klasifikasi/subIV/add', [SubClasificationThController::class, 'create'])->name('klasifikasiTh.create');
    Route::post('/klasifikasi/subIV/store', [SubClasificationThController::class, 'store'])->name('klasifikasiTh.store');
    Route::get('/klasifikasi/subIV/{id}', [SubClasificationThController::class, 'show']);
    Route::get('/klasifikasi/subIV/{id}/edit', [SubClasificationThController::class, 'edit'])->name('klasifikasiTh.edit');
    Route::put('/klasifikasi/subIV/{id}', [SubClasificationThController::class, 'update'])->name('klasifikasiTh.update');
    Route::delete('/klasifikasi/subIV/{id}', [SubClasificationThController::class, 'destroy'])->name('klasifikasiTh.destroy');


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
    Route::get('/paket/bukuRusak/exportFileAllBooks', [PackageBookController::class, 'exportFileAllBooks'])->name('paket.allExport');





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

    Route::get('/pengayaan/damagedBooks/exportFile', [EnrichmentbookController::class, 'exportFile'])->name('enrichmentBooks.damagedExport');
    Route::get('/pengayaan/damagedBooks/exportFileAllBooks', [EnrichmentbookController::class, 'exportFileAllBooks'])->name('enrichmentBooks.allExport');







// Peminjaman Buku Pengayaan
    Route::get('/peminjamanpengayaan', [PeminjamanBukuPengayaanController::class, 'index'])->name('peminjamanbukupengayaan.index');
    Route::get('/peminajamanpengayaan/add', [PeminjamanBukuPengayaanController::class, 'create'])->name('peminjamanbukupengayaan.create');
    Route::post('/peminjamanpengayaan/store', [PeminjamanBukuPengayaanController::class, 'store'])->name('peminjamanbukupengayaan.store');
    Route::get('/get-books/{judulId}', [PeminjamanBukuPengayaanController::class, 'getBooksByJudul'])->name('get.books');
    Route::patch('/peminjamanbukupengayaan/{id}', [PeminjamanBukuPengayaanController::class, 'update'])->name('peminjamanbukupengayaan.update');
    Route::delete('/peminjamanbukupengayaan/{id}', [PeminjamanBukuPengayaanController::class, 'destroy'])->name('peminjamanbukupengayaan.destroy');


// Export
    Route::get('/test', [ExportController::class, 'test'])->name('test');
    Route::get('/export-siswa', [ExportController::class, 'exportStudent'])->name('exportStudents');
    Route::get('/export-peminjaman-paket', [ExportController::class, 'exportPeminjamanPaket'])->name('exportPeminjamanPaket');
    Route::get('/export-peminjaman-pengayaan', [ExportController::class, 'exportPeminjamanPengayaan'])->name('exportPeminjamanPengayaan');





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






