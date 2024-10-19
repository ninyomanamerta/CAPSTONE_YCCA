<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

#Test front end
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
