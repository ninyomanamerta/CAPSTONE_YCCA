<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailEnrichmentBook;

class DetailenrichmentbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailEnrichmentBooks = DetailEnrichmentBook::all();
        return view('detailenrichmentbooks.index', compact('detailEnrichmentBooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('detailenrichmentbooks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pengayaan' => 'required|exists:enrichment_book,id',
            'judul' => 'required|string|max:255',
            'no_induk' => 'required|integer',
        ]);

        DetailEnrichmentBook::create($request->all());

        return redirect()->route('detailenrichmentbooks.index')
                         ->with('success', 'Detail enrichment book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailEnrichmentBook $detailEnrichmentBook)
    {
        return view('detailenrichmentbooks.show', compact('detailEnrichmentBook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailEnrichmentBook $detailEnrichmentBook)
    {
        return view('detailenrichmentbooks.edit', compact('detailEnrichmentBook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailEnrichmentBook $detailEnrichmentBook)
    {
        $request->validate([
            'id_pengayaan' => 'required|exists:enrichment_book,id',
            'judul' => 'required|string|max:255',
            'no_induk' => 'required|integer',
        ]);

        $detailEnrichmentBook->update($request->all());

        return redirect()->route('detailenrichmentbooks.index')
                         ->with('success', 'Detail enrichment book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailEnrichmentBook $detailEnrichmentBook)
    {
        $detailEnrichmentBook->delete();

        return redirect()->route('detailenrichmentbooks.index')
                         ->with('success', 'Detail enrichment book deleted successfully.');
    }
}
