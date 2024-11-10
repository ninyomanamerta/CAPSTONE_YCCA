<?php

namespace App\Http\Controllers;

use App\Models\BookType;
use Illuminate\Http\Request;

class BookTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookType = BookType::all();
        return view('klasifikasi.jenis', compact('bookType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('klasifikasi.addform.addjenis');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|unique:type_books,jenis',
            'noinduk' => 'required|string|unique:type_books,noinduk',
        ]);

        BookType::create([
            'jenis' => $request->jenis,
            'noinduk' => $request->noinduk,
        ]);

        return redirect()->route('rak.index')->with('success', 'Data rak berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BookType $bookType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookType $bookType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookType $bookType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookType $bookType)
    {
        //
    }
}
