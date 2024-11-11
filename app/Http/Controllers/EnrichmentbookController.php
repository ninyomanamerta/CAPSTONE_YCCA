<?php

namespace App\Http\Controllers;

use App\Models\EnrichmentBook;
use Illuminate\Http\Request;
use App\Models\BookCase;

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
        $request->validate([
            'tgl_masuk' => 'required|date',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|numeric',
            'pengarang' => 'required|string|max:255',
            'eksemplar' => 'required|numeric',
            'penerbit' => 'required|string',
            'id_rak' => 'required|exists:bookcases,id',
        ]);

        EnrichmentBook::create($request->all());

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
        $enrichmentBooks = enrichmentBook::findOrFail($id);
        $enrichmentBooks->delete();

        return redirect()->route('enrichmentBooks.index')->with('success', 'Buku Pengayaan Telah Terhapus');
    }
}
