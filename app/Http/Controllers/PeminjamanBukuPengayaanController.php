<?php

namespace App\Http\Controllers;

use App\Models\detailenrichmentbook;
use App\Models\peminjaman_buku_pengayaan;
use App\Models\Student;
use App\Models\enrichmentbook;
use Illuminate\Http\Request;

class PeminjamanBukuPengayaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman_pengayaan = peminjaman_buku_pengayaan::with('student', 'book')->get(); // Ambil data dengan relasi
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
        ]);

        // Store peminjaman data
        peminjaman_buku_pengayaan::create([
            'id_siswa' => $request->id_siswa,
            'id_judul_buku' => $request->id_judul_buku,
            'id_detail_buku' => $request->id_detail_buku,
            'peminjam' => $request->peminjam,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'status' => 'dipinjam',
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
        $peminjaman_buku_pengayaan = peminjaman_buku_pengayaan::findOrFail($id);
        $peminjaman_buku_pengayaan->delete();
        return redirect()->route('peminjamanbukupengayaan.index')->with('success', 'Peminjaman berhasil dihapus!');
    }

    public function getBooksByJudul($judulId)
    {
        $books = detailenrichmentbook::where('id_pengayaan', $judulId)
            ->where('status_peminjaman', 'available')
            ->get(['id', 'no_induk']); // Ensure you're fetching 'id' and 'no_induk'

        return response()->json($books);
    }

    // App\Models\peminjaman_buku_pengayaan.php



}
