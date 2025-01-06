<?php

namespace App\Http\Controllers;

use App\Models\detailenrichmentbook;
use App\Models\peminjaman_buku_pengayaan;
use App\Models\Student;
use App\Models\enrichmentbook;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanBukuPengayaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now(); // Waktu saat ini

        // Update status 'telat' jika tanggal pengembalian sudah lewat hari ini
        peminjaman_buku_pengayaan::where('status', 'dipinjam')
            ->whereDate('tgl_pengembalian', '<', $today)
            ->update(['status' => 'telat']);

        // Ambil data peminjaman
        $peminjaman_pengayaan = peminjaman_buku_pengayaan::with([
            'student',
            'book',
            'detailEnrichmentBook',
            'enrichmentBook',
            'jenis',
            'mapel',
            'submapel',
            'subkelas',
            'subklasifikasi',
            'subklasifikasith'
        ])->get();


        return view('peminjaman_pengayaan.index', compact('peminjaman_pengayaan'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all(); // Ambil semua data siswa
        $judulbuku = enrichmentbook::all(); // Ambil semua data buku pengayaan
        // Ambil hanya buku yang statusnya 'available'
        $book = detailenrichmentbook::where('status_peminjaman', 'available')->get();

        return view('peminjaman_pengayaan.create', compact('students', 'book', 'judulbuku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:students,id',
            'id_judul_buku' => 'required|exists:enrichment_book,id', // Ensure 'id_judul_buku' is valid
            'id_detail_buku' => 'required|exists:detail_enrichment_book,id,id_pengayaan,' . $request->id_judul_buku, // Validate 'id_detail_buku' with 'id_judul_buku'
            'peminjam' => 'required|string|max:255',
            'tgl_pinjam' => 'required|date',
            'tgl_pengembalian' => 'required|date',
            'keterangan' => 'nullable|string|max:500',
        ]);

        // Store peminjaman data
        peminjaman_buku_pengayaan::create([
            'id_siswa' => $request->id_siswa,
            'id_judul_buku' => $request->id_judul_buku,
            'id_detail_buku' => $request->id_detail_buku,
            'peminjam' => $request->peminjam,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);
        // Update status buku menjadi 'dipinjam'
        $book = detailenrichmentbook::find($request->id_detail_buku); // Temukan buku berdasarkan id
        if ($book) {
            $book->status_peminjaman = 'dipinjam'; // Perbarui status
            $book->save(); // Simpan perubahan
        }

        return redirect()->route('peminjamanbukupengayaan.index')->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(peminjaman_buku_pengayaan $peminjaman_buku_pengayaan)
    {
        return view('peminjaman_pengayaan.show', compact('peminjaman_buku_pengayaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(peminjaman_buku_pengayaan $peminjaman_buku_pengayaan)
    {
        $students = Student::all();
        $books = enrichmentbook::all();

        return view('peminjaman_pengayaan.edit', compact('peminjaman_buku_pengayaan', 'students', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the peminjaman record by ID
        $peminjaman = peminjaman_buku_pengayaan::findOrFail($id);

        // Update the status of the peminjaman
        $peminjaman->status = $request->input('status');
        $peminjaman->keterangan = $request->input('verifikasi_buku');

        // Jika status peminjaman berubah menjadi 'dikembalikan', perbarui status buku
        if ($peminjaman->status === 'dikembalikan') {
            // Temukan buku detail berdasarkan id_detail_buku
            $book = detailenrichmentbook::find($peminjaman->id_detail_buku);

            if ($book) {
                // Update status buku menjadi 'available'
                $book->status_peminjaman = 'available';
                $book->save(); // Simpan perubahan status buku
            }
        }

        // Simpan perubahan peminjaman
        $peminjaman->save();

        // Redirect back with a success message
        return redirect()->route('peminjamanbukupengayaan.index')
            ->with('success', 'Status peminjaman berhasil diperbarui.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan peminjaman berdasarkan id
        $peminjaman_buku_pengayaan = peminjaman_buku_pengayaan::findOrFail($id);

        // Temukan buku detail yang terhubung dengan peminjaman
        $book = detailenrichmentbook::find($peminjaman_buku_pengayaan->id_detail_buku);

        // Jika buku ditemukan, ubah statusnya menjadi 'available'
        if ($book) {
            $book->status_peminjaman = 'available'; // Ubah status menjadi available
            $book->save(); // Simpan perubahan
        }

        // Hapus data peminjaman
        $peminjaman_buku_pengayaan->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('peminjamanbukupengayaan.index')
                         ->with('success', 'Peminjaman berhasil dihapus dan status buku diperbarui menjadi available!');
    }


    public function getBooksByJudul($judulId)
    {
        $books = detailenrichmentbook::where('id_pengayaan', $judulId)
            ->where('status_peminjaman', 'available')
            ->get(['id','no_induk']); // Ensure you're fetching 'id' and 'no_induk'

            return response()->json($books->map(function($book) {
                return [
                    'id' => $book->id,  // Menyertakan ID untuk keperluan pengambilan data lebih lanjut
                    'no_induk' => $book->no_induk // Menampilkan no_induk untuk kebutuhan tampilan
                ];
            }));


    }

    // App\Models\peminjaman_buku_pengayaan.php


    public function notification()
    {
        $today = Carbon::now();
        $count = peminjaman_buku_pengayaan::where('status', 'telat')
            // ->whereDate('tgl_pinjam', '<=', $today->subDays(7)) // Sudah lebih dari 7 hari
            ->count();

        return $count;
    }

    // public function updateLateStatus()
    // {
    //     $today = Carbon::today(); // Hari ini, mulai dari pukul 00:00

    //     // Ambil semua peminjaman yang masih 'dipinjam' dan sudah lewat tanggal pengembalian
    //     $overdueLoans = peminjaman_buku_pengayaan::where('status', 'dipinjam')
    //         ->whereDate('tgl_pengembalian', '<', $today)
    //         ->get();

    //     foreach ($overdueLoans as $loan) {
    //         $loan->status = 'telat'; // Perbarui status ke 'telat'
    //         $loan->save(); // Simpan perubahan
    //     }
    // }




}
