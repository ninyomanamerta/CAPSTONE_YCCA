<?php

namespace App\Http\Controllers;

use App\Models\EnrichmentBook;
use Illuminate\Http\Request;
use App\Models\BookCase;
use App\Models\detailenrichmentbook;
use Illuminate\Support\Facades\DB;
use App\Imports\EnrichmentImport;
use Excel;

class EnrichmentbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrichmentBooks = EnrichmentBook::withCount('detailEnrichmentBooks')->get();
        return view('pengayaan.index', compact('enrichmentBooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookcases = Bookcase::all(); // Mengambil semua data rak
        return view('pengayaan.create', compact('bookcases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'tgl_masuk' => 'required|date',
            'kategori' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|numeric',
            'pengarang' => 'required|string|max:255',
            'eksemplar' => 'required|numeric',
            'penerbit' => 'required|string',
            'id_rak' => 'required|exists:bookcases,id',
        ]);

        $lastNomorInduk = detailenrichmentbook::max('no_induk');

        $nomorInduk = $lastNomorInduk ? $lastNomorInduk + 1 : 1;

        $enrichmentBooks = EnrichmentBook::create([
            'tgl_masuk' => $validated['tgl_masuk'],
            'kategori' => $validated['kategori'],
            'judul' => $validated['judul'],
            'tahun' => $validated['tahun'],
            'pengarang' => $validated['pengarang'],
            'eksemplar' => $validated['eksemplar'],
            'penerbit' => $validated['penerbit'],
            'id_rak' => $validated['id_rak']
        ]);

        for ($i = 0; $i < $validated['eksemplar']; $i++) {
            detailenrichmentbook::create([
                'id_pengayaan' => $enrichmentBooks->id,
                'status_peminjaman' => 'available',
                'no_induk' => $nomorInduk + $i,
            ]);
        }
        return redirect()->route('enrichmentBooks.index')
            ->with('success', 'Buku Pengayaan Telah Tersimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $enrichmentBooks = EnrichmentBook::findOrFail($id);
        return response()->json($enrichmentBooks);
    }

    public function detail($id)
    {
        $enrichmentBooks = EnrichmentBook::with('detailEnrichmentBooks')
            ->findOrFail($id);

        $enrichmentBooksCount = EnrichmentBook::withCount('detailEnrichmentBooks')->findOrFail($id);

        // Hitung jumlah eksemplar yang dipinjam
        $jumlahDipinjam = $enrichmentBooks->detailEnrichmentBooks
            ->where('status_peminjaman', '!=', 'available')
            ->count();

        return view('pengayaan.detail', compact('enrichmentBooks', 'jumlahDipinjam', 'enrichmentBooksCount'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mengambil data buku berdasarkan ID
        $enrichmentBooks = EnrichmentBook::findOrFail($id);

        // Mengambil semua rak untuk dropdown
        $bookcases = Bookcase::all();

        // Mengirim data ke view
        return view('pengayaan.edit', compact('enrichmentBooks', 'bookcases'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $enrichmentBooks = EnrichmentBook::findOrFail($id);
        $request->validate([
            'tgl_masuk' => 'required|date',
            'kategori' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|numeric',
            'pengarang' => 'required|string|max:255',
            'eksemplar' => 'required|numeric',
            'penerbit' => 'required|string',
            'id_rak' => 'required|exists:bookcases,id',
        ]);

        $enrichmentBooks->update([
            'tgl_masuk' => $request->tgl_masuk,
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'pengarang' => $request->pengarang,
            'eksemplar' => $request->eksemplar,
            'penerbit' => $request->penerbit,
            'id_rak' => $request->id_rak
        ]);

        return redirect()->route('enrichmentBooks.index')
            ->with('success', 'Buku Pengayaan Telah diperbaiki');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Hapus data yang terkait di tabel detail_enrichment_book
        detailenrichmentbook::where('id_pengayaan', $id)->delete();

        // Hapus data di tabel enrichment_book
        $enrichmentBooks = EnrichmentBook::findOrFail($id);
        $enrichmentBooks->delete();

        return redirect()->route('enrichmentBooks.index')->with('success', 'Buku Pengayaan Telah Terhapus');
    }

    public function destroyDetail($id)
    {

        $detailEnrichmentBook = detailenrichmentbook::findOrFail($id);
        $enrichmentBookId = $detailEnrichmentBook->id_pengayaan;

        $detailEnrichmentBook->delete();

        return redirect()->route('enrichmentBooks.detail', $enrichmentBookId)
            ->with('success', 'Detail buku berhasil dihapus');
    }

    public function damagedBooks() {
        $enrichmentBooks = enrichmentbook::with(['detailEnrichmentBooks' => function($query) {
            $query->where('status_peminjaman', 'available');
        }])->get();


        return view('pengayaan.damagedBooks', compact('enrichmentBooks'));
    }

    public function updateDamagedBooks(Request $request)
    {
        $damagedBooks = $request->input('damaged_books', []);

        if (!empty($damagedBooks)) {
            detailenrichmentbook::whereIn('id', $damagedBooks)
                            ->update(['status_peminjaman' => 'damaged']);
        }

        return redirect()->route('enrichmentBooks.index')->with('success', 'Buku Pengayaan berhasil ditandai rusak');
    }

    public function showAll()
    {
        $enrichmentBooks = enrichmentbook::with('detailEnrichmentBooks')->get();
        return view('pengayaan.showAll', compact('enrichmentBooks'));
    }

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:detail_enrichment_book,id',
            'status' => 'required|in:available,damaged,nonavailable',
        ]);

        $bookDetail = detailenrichmentbook::findOrFail($validated['id']);
        $bookDetail->status_peminjaman = $validated['status'];
        $bookDetail->save();

        return redirect()->back()->with('success', 'Status buku berhasil diubah.');
    }

    public function destroyAll($id)
    {
        DB::beginTransaction();

        try {
            $enrichmentBook = EnrichmentBook::findOrFail($id);

            if ($enrichmentBook->detailEnrichmentBooks()->exists()) {
                foreach ($enrichmentBook->detailEnrichmentBooks as $detail) {
                    $detail->borrowedEnrichmentBooks()->delete();
                    $detail->delete();
                }
            }

            $enrichmentBook->delete();

            DB::commit();

            return redirect()->route('enrichmentBooks.index')->with('success', 'Buku pengayaan beserta data peminjaman terkait berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('enrichmentBooks.index')->with('error', 'Gagal menghapus buku pengayaan: ' . $e->getMessage());
        }
    }


    public function import()
    {
        return view('pengayaan.import');
    }

    public function proses(Request $request)
    {
        Excel::import(new EnrichmentImport, $request->file('books'));

        return redirect()->route('enrichmentBooks.index')->with('success', 'Data buku pengayaan berhasil ditambahkan!');

    }




}
