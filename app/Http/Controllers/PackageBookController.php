<?php

namespace App\Http\Controllers;

use App\Models\PackageBook;
use App\Models\DetailPackageBook;
use App\Models\BookType;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\SubClass;
use App\Models\SubClasification;
use App\Models\SubClasificationTh;
use App\Exports\ExportDamagedPackageBook;
use App\Exports\ExportAllPackageBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;

class PackageBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packageBook = PackageBook::withCount('detailPackageBooks')->get();
        return view("paket.index", compact("packageBook"));
    }

    public function detail($id)
    {
        $packageBook = PackageBook::with('detailPackageBooks')
        ->findOrFail($id);

        return view('paket.detail', compact('packageBook'));
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
        $subClasification = SubClasification::all();
        $subClasificationTh = SubClasificationTh::all();

        return view('paket.create', compact('types', 'courses', 'subCourses', 'subClasses', 'subClasification', 'subClasificationTh'));
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
            'klasifikasi_subkelas' => 'nullable|exists:sub_class,id',
            'klasifikasi_subclasification' => 'nullable|exists:sub_clasification,id',
            'klasifikasi_subclasificationth' => 'nullable|exists:sub_clasification4,id',
            'tgl_masuk' => 'required|date',
            'tahun_terbit' => 'required|numeric',
            'penerbit' => 'required|string|max:255',
            'sumber' => 'nullable|string|max:255',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $query = PackageBook::query();

        $query->where('judul', $validated['judul'])
            ->where('id_jenis', $validated['klasifikasi_jenis'])
            ->where('id_mapel', $validated['klasifikasi_mapel']);

        if (!empty($validated['klasifikasi_submapel'])) {
            $query->where('id_submapel', $validated['klasifikasi_submapel']);
        } else {
            $query->whereNull('id_submapel');
        }

        if (!empty($validated['klasifikasi_subkelas'])) {
            $query->where('id_subkelas', $validated['klasifikasi_subkelas']);
        } else {
            $query->whereNull('id_subkelas');
        }

        if (!empty($validated['klasifikasi_subclasification'])) {
            $query->where('id_subklasifikasi', $validated['klasifikasi_subclasification']);
        } else {
            $query->whereNull('id_subklasifikasi');
        }

        if (!empty($validated['klasifikasi_subclasificationth'])) {
            $query->where('id_subklasifikasith', $validated['klasifikasi_subclasificationth']);
        } else {
            $query->whereNull('id_subklasifikasith');
        }

        $existingPackageBook = $query->first();


        if (!$existingPackageBook) {
            $packageBookData = [
                'tgl_masuk' => $validated['tgl_masuk'],
                'judul' => $validated['judul'],
                'tahun_terbit' => $validated['tahun_terbit'],
                'penerbit' => $validated['penerbit'],
                'eksemplar' => $validated['jumlah'],
                'sumber' => $validated['sumber'],
                'id_jenis' => $validated['klasifikasi_jenis'],
                'id_mapel' => $validated['klasifikasi_mapel'],
            ];

            if (!empty($validated['klasifikasi_submapel'])) {
                $packageBookData['id_submapel'] = $validated['klasifikasi_submapel'];
            }

            if (!empty($validated['klasifikasi_subkelas'])) {
                $packageBookData['id_subkelas'] = $validated['klasifikasi_subkelas'];
            }

            if (!empty($validated['klasifikasi_subclasification'])) {
                $packageBookData['id_subklasifikasi'] = $validated['klasifikasi_subclasification'];
            }

            if (!empty($validated['klasifikasi_subclasificationth'])) {
                $packageBookData['id_subklasifikasith'] = $validated['klasifikasi_subclasificationth'];
            }

            $packageBook = PackageBook::create($packageBookData);
            $nomorInduk = 1;

        } else {
            $lastNomorInduk = DetailPackageBook::where('id_package_books', $existingPackageBook->id)
                ->max('nomor_induk');

            $nomorInduk = $lastNomorInduk ? $lastNomorInduk + 1 : 1;
            $packageBook = $existingPackageBook;
        }

        for ($i = 0; $i < $validated['jumlah']; $i++) {
            DetailPackageBook::create([
                'id_package_books' => $packageBook->id,
                'nomor_induk' => $nomorInduk + $i,
                'status_peminjaman' => 'available',
                'tgl_masuk' => $validated['tgl_masuk'],
            ]);
        }

        return redirect()->route('paket.index')->with('success', 'Buku Paket berhasil ditambahkan');
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
    public function edit($id)
    {
        $packageBook = PackageBook::with('detailPackageBooks')->findOrFail($id);
        $types = BookType::all();
        $courses = Course::all();
        $subCourses = SubCourse::all();
        $subClasses = SubClass::all();
        $subClasification = SubClasification::all();
        $subClasificationTh = SubClasificationTh::all();


        return view('paket.edit', compact('types', 'courses', 'subCourses', 'subClasses', 'packageBook', 'subClasification', 'subClasificationTh'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $packageBook = PackageBook::findOrFail($id);

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'klasifikasi_jenis' => 'required|exists:type_books,id',
            'klasifikasi_mapel' => 'required|exists:courses,id',
            'klasifikasi_submapel' => 'nullable|exists:sub_courses,id',
            'klasifikasi_subkelas' => 'required|exists:sub_class,id',
            'klasifikasi_subclasification' => 'nullable|exists:sub_clasification,id',
            'klasifikasi_subclasificationth' => 'nullable|exists:sub_clasification4,id',
            'tgl_masuk' => 'required|date',
            'tahun_terbit' => 'required|numeric',
            'penerbit' => 'required|string|max:255',
            'sumber' => 'required|string|max:255',
        ]);

        $packageBookData = [
            'judul' => $validatedData['judul'],
            'id_jenis' => $validatedData['klasifikasi_jenis'],
            'id_mapel' => $validatedData['klasifikasi_mapel'],
            'tgl_masuk' => $validatedData['tgl_masuk'],
            'tahun_terbit' => $validatedData['tahun_terbit'],
            'penerbit' => $validatedData['penerbit'],
            'sumber' => $validatedData['sumber'],
        ];

        if (!empty($validatedData['klasifikasi_submapel'])) {
            $packageBookData['id_submapel'] = $validatedData['klasifikasi_submapel'];
        }

        if (!empty($validatedData['klasifikasi_subkelas'])) {
            $packageBookData['id_subkelas'] = $validatedData['klasifikasi_subkelas'];
        }

        if (!empty($validatedData['klasifikasi_subclasification'])) {
            $packageBookData['id_subklasifikasi'] = $validatedData['klasifikasi_subclasification'];
        }

        if (!empty($validatedData['klasifikasi_subclasificationth'])) {
            $packageBookData['id_subklasifikasith'] = $validatedData['klasifikasi_subclasificationth'];
        }

        $packageBook->update($packageBookData);

        return redirect()->route('paket.index')->with('success', 'Buku Paket berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detailPackageBook = DetailPackageBook::findOrFail($id);
        $detailPackageBook->delete();

        return redirect()->route('paket.detail', $detailPackageBook->id_package_books)
        ->with('success', 'Data buku berhasil dihapus');
    }

    public function destroyAll($id)
    {
        DB::beginTransaction();

        try {
            $packageBook = PackageBook::findOrFail($id);

            $packageBook->detailPackageBooks()->delete();
            $packageBook->delete();
            DB::commit();

            return redirect()->route('paket.index')->with('success', 'Buku paket berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('paket.index')->with('error', 'Gagal menghapus semua buku paket: ' . $e->getMessage());
        }
    }

    public function showDamagedBook()
    {

        $packageBook = PackageBook::with(['detailPackageBooks' => function($query) {
            $query->where('status_peminjaman', 'available');
            }])->get();
        return view('paket.damagedBook', compact('packageBook'));

    }

    public function updateDamagedBook(Request $request)
    {
        $damagedBooks = $request->input('damaged_books', []);

        if (!empty($damagedBooks)) {
            DetailPackageBook::whereIn('id', $damagedBooks)
                            ->update(['status_peminjaman' => 'damaged']);
        }

        return redirect()->route('paket.index')->with('success', 'Buku berhasil ditandai rusak');
    }

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:detail_package_books,id',
            'status' => 'required|in:available,damaged,nonavailable',
        ]);

        $bookDetail = DetailPackageBook::findOrFail($validated['id']);
        $bookDetail->status_peminjaman = $validated['status'];
        $bookDetail->save();

        return redirect()->back()->with('success', 'Status buku berhasil diubah.');
    }

    public function showAll()
    {
        $packageBook = PackageBook::with('detailPackageBooks')
        ->get();

        return view('paket.showAll', compact('packageBook'));
    }

    public function exportFile()
    {
        return Excel::download(new ExportDamagedPackageBook, 'Buku Paket Rusak.xlsx');
    }

    public function exportFileAllBooks()
    {
        return Excel::download(new ExportAllPackageBook, 'Buku Paket.xlsx');
    }



}
