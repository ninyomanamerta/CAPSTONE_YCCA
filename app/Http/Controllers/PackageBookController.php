<?php

namespace App\Http\Controllers;

use App\Models\PackageBook;
use App\Models\DetailPackageBook;
use App\Models\BookType;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\SubClass;
use Illuminate\Http\Request;

class PackageBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = BookType::all();
        $courses = Course::all();
        $subCourses = SubCourse::all();
        $subClasses = SubClass::all();

        return view('paket.create', compact('types', 'courses', 'subCourses', 'subClasses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'klasifikasi_jenis' => 'required|exists:type_books,id',
            'klasifikasi_mapel' => 'required|exists:courses,id',
            'klasifikasi_submapel' => 'nullable|exists:sub_courses,id',
            'klasifikasi_subkelas' => 'required|exists:sub_class,id',
            'tgl_masuk' => 'required|date',
            'tahun_terbit' => 'required|numeric',
            'penerbit' => 'required|string|max:255',
            'sumber' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $lastNomorInduk = DetailPackageBook::max('nomor_induk');

        $nomorInduk = $lastNomorInduk ? $lastNomorInduk + 1 : 1;

        $packageBook = PackageBook::create([
            'tgl_masuk' => $validated['tgl_masuk'],
            'judul' => $validated['judul'],
            'tahun_terbit' => $validated['tahun_terbit'],
            'penerbit' => $validated['penerbit'],
            'eksemplar' => $validated['jumlah'],
            'sumber' => $validated['sumber'],
            'id_jenis' => $validated['klasifikasi_jenis'],
            'id_mapel' => $validated['klasifikasi_mapel'],
            'id_submapel' => $validated['klasifikasi_submapel'],
            'id_subkelas' => $validated['klasifikasi_subkelas'],
        ]);

        for ($i = 0; $i < $validated['jumlah']; $i++) {
            DetailPackageBook::create([
                'id_package_books' => $packageBook->id,
                'nomor_induk' => $nomorInduk + $i,
                'status_peminjaman' => 'available',
            ]);
        }

        return redirect()->route('paket.create')->with('success', 'Buku Paket berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageBook $packageBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageBook $packageBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackageBook $packageBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageBook $packageBook)
    {
        //
    }
}
