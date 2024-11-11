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
        $jenis = BookType::all();
        return view("klasifikasi.jenisbuku.jenis", compact("jenis"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("klasifikasi.jenisbuku.addjenis");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'jenis_buku' => 'required|string|max:100',
            'nomor_induk_jenis' => 'required|string|max:20',
        ]);

        // Create a new BookType record
        BookType::create([
            'jenis_buku' => $request->jenis_buku,
            'nomor_induk_jenis' => $request->nomor_induk_jenis,
        ]);

        // Redirect with success message
        return redirect()->route('jenis.index')->with('success', 'Jenis Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jenis = BookType::findOrFail($id);
        return response()->json($jenis);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    { {
            // Find the BookType by ID
            $jenis = BookType::findOrFail($id);

            // Return the edit view with the 'jenis' data
            return view('klasifikasi.jenisbuku.editjenis', compact('jenis'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    { {
            // Validate the incoming request
            $request->validate([
                'jenis_buku' => 'required|string|max:100',
                'nomor_induk_jenis' => 'required|string|max:20',
            ]);

            // Find the BookType by ID
            $jenis = BookType::findOrFail($id);

            // Update the BookType record
            $jenis->update([
                'jenis_buku' => $request->jenis_buku,
                'nomor_induk_jenis' => $request->nomor_induk_jenis,
            ]);

            // Redirect with success message
            return redirect()->route('jenis.index')->with('success', 'Jenis Buku berhasil diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $jenis = BookType::findOrFail($id);
        $jenis->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis Buku berhasil dihapus!');
    }
}
