<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanBukuPaket;
use App\Models\DetailPeminjamanBukuPaket;
use App\Models\PackageBook;
use App\Models\DetailPackageBook;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanBukuPaketController extends Controller
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
        $students = Student::all();
        $books = PackageBook::whereHas('detailPackageBooks', function ($query) {
            $query->where('status_peminjaman', 'available');
        })->get();


        return view('peminjaman_paket.create', compact('students', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student' => 'required|exists:students,id',
            'pic' => 'required|string|max:255',
            'books' => 'required|array',
            'books.*' => 'exists:detail_package_books,id',
        ]);

        DB::beginTransaction();

        try {
            $peminjaman = PeminjamanBukuPaket::create([
                'id_siswa' => $validated['student'],
                'penanggung_jawab' => $validated['pic'],
            ]);

            foreach ($validated['books'] as $bookId) {
                DetailPeminjamanBukuPaket::create([
                    'id_pinjam' => $peminjaman->id,
                    'id_buku_paket' => $bookId,
                    'status_peminjaman' => 'borrowed',
                ]);

                $detailBook = DetailPackageBook::findOrFail($bookId);
                $detailBook->update([
                    'status_peminjaman' => 'nonavailable',
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Peminjaman buku berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses peminjaman.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PeminjamanBukuPaket $peminjamanBukuPaket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PeminjamanBukuPaket $peminjamanBukuPaket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PeminjamanBukuPaket $peminjamanBukuPaket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PeminjamanBukuPaket $peminjamanBukuPaket)
    {
        //
    }
}
