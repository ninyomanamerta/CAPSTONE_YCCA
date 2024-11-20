<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanBukuPaket;
use App\Models\DetailPeminjamanBukuPaket;
use App\Models\PackageBook;
use App\Models\DetailPackageBook;
use App\Models\BookType;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\SubClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanBukuPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswaPeminjam = Student::with(['peminjamanBukuPaket'])
            ->whereHas('peminjamanBukuPaket', function ($query) {
                $query->whereNotNull('id');
            })
            ->orderByRaw("SUBSTRING_INDEX(kelas, '', 1), kelas")
            ->get();

        // Return ke view dengan data siswa peminjaman
        return view('peminjaman_paket.index', compact('siswaPeminjam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $students = Student::query()
            ->orderByRaw("SUBSTRING_INDEX(kelas, ' ', 1), kelas")
            ->get();
        $books = PackageBook::with(['detailPackageBooks' => function ($query) {
            $query->where('status_peminjaman', 'available');
        }, 'jenis', 'mapel', 'submapel', 'subkelas'])
        ->get();


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

            $student = Student::findOrFail($validated['student']);

            $currentClassLevel = intval(substr($student->kelas, 0, 1));

        // Periksa apakah sudah ada peminjaman di tingkat kelas ini
            $existingLoan = PeminjamanBukuPaket::where('id_siswa', $student->id)
            ->whereRaw('CAST(LEFT(kelas, 1) AS UNSIGNED) = ?', [$currentClassLevel])
            ->exists();

            if ($existingLoan) {
                return redirect()->back()->withErrors(['student' => 'Siswa ini sudah melakukan peminjaman di tingkat kelas ' . $currentClassLevel]);
            }

            $peminjaman = PeminjamanBukuPaket::create([
                'id_siswa' => $student->id,
                'penanggung_jawab' => $validated['pic'],
                'kelas' => $student->kelas,
            ]);

            foreach ($validated['books'] as $bookId) {
                DetailPeminjamanBukuPaket::create([
                    'id_pinjam' => $peminjaman->id,
                    'id_buku_paket' => $bookId,
                    'status_peminjaman' => 'borrowed',
                    'tanggal_pinjam' => Carbon::now(),


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

    public function showPeminjamanByClassLevels($id)
    {
        // Ambil data siswa berdasarkan ID
        $student = Student::findOrFail($id);

        $peminjamanByClassLevels = [
            '7' => PeminjamanBukuPaket::with([
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.jenis',
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.mapel',
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.submapel',
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.subkelas'
            ])
            ->where('id_siswa', $id)
            ->where('kelas', 'like', '7%')
            ->get(),

            '8' => PeminjamanBukuPaket::with([
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.jenis',
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.mapel',
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.submapel',
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.subkelas'
            ])
            ->where('id_siswa', $id)
            ->where('kelas', 'like', '8%')
            ->get(),

            '9' => PeminjamanBukuPaket::with([
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.jenis',
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.mapel',
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.submapel',
                'detailPeminjamanBukuPaket.bukuPaket.packageBook.subkelas'
            ])
            ->where('id_siswa', $id)
            ->where('kelas', 'like', '9%')
            ->get(),
        ];


        // dd($peminjamanByClassLevels);

        return view('peminjaman_paket.detail', compact('student', 'peminjamanByClassLevels'));
    }



    public function show($id)
    {

        $peminjamanPaket = PeminjamanBukuPaket::with('detailPeminjamanBukuPaket.bukuPaket.packageBook')
        ->find($id); // Gunakan find daripada findOrFail untuk debugging

        if (!$peminjamanPaket) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $detail = $peminjamanPaket->detailPeminjamanBukuPaket->first();

        return response()->json([
            'detailPeminjamanBukuPaket' => $detail,
        ]);
    }

    public function showModal($id)
{
    \Log::info('Request for modal with ID: ' . $id);

    try {
        $detailPeminjaman = DetailPeminjamanBukuPaket::with([
            'bukuPaket.packageBook.jenis',
            'bukuPaket.packageBook.mapel',
            'bukuPaket.packageBook.submapel',
            'bukuPaket.packageBook.subkelas'
        ])->findOrFail($id);

        \Log::info('Detail Peminjaman: ', $detailPeminjaman->toArray());

        return response()->json(['detailPeminjamanBukuPaket' => $detailPeminjaman]);
    } catch (\Exception $e) {
        \Log::error('Error fetching detail: ' . $e->getMessage());
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $peminjamanPaket = PeminjamanBukuPaket::with('detailPeminjamanBukuPaket.bukuPaket.packageBook', 'siswa')->findOrFail($id);

        $books = PackageBook::with(['detailPackageBooks' => function ($query) {
            $query->where('status_peminjaman', 'available');
        }, 'jenis', 'mapel', 'submapel', 'subkelas'])
        ->get();

    return view('peminjaman_paket.edit', compact('peminjamanPaket', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student' => 'required|exists:students,id',
            'pic' => 'required|string|max:255',
            'books' => 'nullable|array',
            'books.*' => 'exists:detail_package_books,id',
        ]);

        DB::beginTransaction();

        try {
            $peminjaman = PeminjamanBukuPaket::with('detailPeminjamanBukuPaket')->findOrFail($id);

            $siswaId = $request->input('student');

            // Perbarui hanya data penanggung jawab
            $peminjaman->update([
                'penanggung_jawab' => $validated['pic'],
            ]);

            if (!empty($validated['books'])) {
                foreach ($validated['books'] as $bookId) {
                    $existingBook = $peminjaman->detailPeminjamanBukuPaket->where('id_buku_paket', $bookId)->first();

                    if (!$existingBook) {
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
                }
            }

            DB::commit();
            // return redirect()->back()->with('success', 'Data peminjaman berhasil diperbarui!');
            return redirect("/paket/peminjaman/detail/siswa/{$siswaId}")->with('success', 'Data peminjaman berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data peminjaman.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroyBook($id)
    {
        try {
            $detailBook = DetailPeminjamanBukuPaket::findOrFail($id);
            $packageBookId = $detailBook->id_buku_paket;

            if (!$packageBookId) {
                return redirect()->back()->with('error', 'ID buku paket tidak ditemukan.');
            }

            $detailBook->delete();

            $packageBook = DetailPackageBook::find($packageBookId);
            if (!$packageBook) {
                return redirect()->back()->with('error', 'Buku dengan ID tersebut tidak ditemukan di DetailPackageBook.');
            }

            $packageBook->status_peminjaman = 'available';
            $packageBook->save();

            return redirect()->back()->with('success', 'Detail peminjaman buku paket berhasil dihapus dan status buku diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function status($id)
    {
        $peminjamanPaket = PeminjamanBukuPaket::with('detailPeminjamanBukuPaket.bukuPaket.packageBook', 'siswa')->findOrFail($id);

        $books = PackageBook::with(['detailPackageBooks' => function ($query) {
            $query->where('status_peminjaman', 'available');
        }, 'jenis', 'mapel', 'submapel', 'subkelas'])
        ->get();

    return view('peminjaman_paket.pengembalian', compact('peminjamanPaket', 'books'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'pic-return' => 'required|string',
            'status' => 'array',
            'keterangan' => 'array|nullable',
            'status.*' => 'in:borrowed,returned',
        ]);

        $siswaId = $request->input('student');

        $peminjamanPaket = PeminjamanBukuPaket::findOrFail($id);

        $peminjamanPaket->pengembalian = $validated['pic-return'];
        $peminjamanPaket->save();

        foreach ($peminjamanPaket->detailPeminjamanBukuPaket as $detail) {
            if (isset($validated['status'][$detail->id]) && $validated['status'][$detail->id] !== $detail->status_peminjaman) {
                $detail->status_peminjaman = $validated['status'][$detail->id];
            }

            if (isset($validated['keterangan'][$detail->id]) && $validated['keterangan'][$detail->id] !== $detail->keterangan) {
                $detail->keterangan = $validated['keterangan'][$detail->id];
            }

            $detail->save();

            if ($detail->status_peminjaman == 'returned') {
                $packageBook = DetailPackageBook::where('id', $detail->id_buku_paket)->first();
                if ($packageBook) {
                    $packageBook->status_peminjaman = 'available';
                    $packageBook->save();
                }
            }
        }


        return redirect("/paket/peminjaman/detail/siswa/{$siswaId}")->with('success', 'Pengembalian buku berhasil');
    }





}
