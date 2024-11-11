<?php

namespace App\Http\Controllers;

use App\Models\EnrichmentBook;
use Illuminate\Http\Request;
use App\Models\BookCase;
use App\Models\detailenrichmentbook;

class EnrichmentbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrichmentBooks = EnrichmentBook::all();
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
            'judul' => 'required|string|max:255',
            'tahun' => 'required|numeric',
            'pengarang' => 'required|string|max:255',
            'eksemplar' => 'required|numeric',
            'penerbit' => 'required|string',
            'id_rak' => 'required|exists:bookcases,id',
        ]);

        $lastNomorInduk = detailenrichmentbook::max('no_induk');
        
        $nomorInduk = $lastNomorInduk ? $lastNomorInduk + 1 : 1;

        $enrichmentBooks= EnrichmentBook::create([
            'tgl_masuk' => $validated['tgl_masuk'],
            'judul'=> $validated['judul'],
            'tahun'=> $validated['tahun'],
            'pengarang'=> $validated['pengarang'],
            'eksemplar'=> $validated['eksemplar'],
            'penerbit'=> $validated['penerbit'],
            'id_rak'=> $validated['id_rak']
        ]);

        for ($i = 0; $i < $validated['eksemplar']; $i++) {
            detailenrichmentbook::create([
                'id_pengayaan' => $enrichmentBooks->id,
                'judul' => $enrichmentBooks->judul,
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
            'judul' => 'required|string|max:255',
            'tahun' => 'required|numeric',
            'pengarang' => 'required|string|max:255',
            'eksemplar' => 'required|numeric',
            'penerbit' => 'required|string',
            'id_rak' => 'required|exists:bookcases,id',
        ]);

        $enrichmentBooks->update([
            'tgl_masuk' => $request->tgl_masuk,
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
}
