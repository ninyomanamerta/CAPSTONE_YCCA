<?php

namespace App\Http\Controllers;

use App\Models\enrichmentbook;
use Illuminate\Http\Request;
use App\Models\BookCase;
use App\Models\detailenrichmentbook;
use App\Models\BookType;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\SubClass;
use App\Models\SubClasification;
use App\Models\SubClasificationTh;
use Illuminate\Support\Facades\DB;
use App\Imports\EnrichmentImport;
use App\Exports\ExportDamagedEnrichmentBook;
use App\Exports\ExportAllEnrichmentBook;
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
        $bookcases = Bookcase::all();
        $types = BookType::all();
        $courses = Course::all();
        $subCourses = SubCourse::all();
        $subClasses = SubClass::all();
        $subClasification = SubClasification::all();
        $subClasificationTh = SubClasificationTh::all();
        return view('pengayaan.create', compact('bookcases', 'types', 'courses', 'subCourses', 'subClasses', 'subClasification', 'subClasificationTh'));
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
            'klasifikasi_jenis' => 'required|exists:type_books,id',
            'klasifikasi_mapel' => 'required|exists:courses,id',
            'klasifikasi_submapel' => 'nullable|exists:sub_courses,id',
            'klasifikasi_subkelas' => 'nullable|exists:sub_class,id',
            'klasifikasi_subclasification' => 'nullable|exists:sub_clasification,id',
            'klasifikasi_subclasificationth' => 'nullable|exists:sub_clasification4,id',
        ]);

        $query = EnrichmentBook::query();

        $query->where('judul', $validated['judul'])
            ->where('id_jenis', $validated['klasifikasi_jenis'])
            ->where('id_mapel', $validated['klasifikasi_mapel']);

        if (!empty($validated['klasifikasi_submapel'])) {
            $query->where('id_submapel', $validated['klasifikasi_submapel']);
        } else {
            $query->whereNull('id_submapel');
        }

        if (!empty($validated['klasifikasi_subkelas'])) {
            $query->where('id_subkelas', $validated['klasifikasi_subkelas']);
        } else {
            $query->whereNull('id_subkelas');
        }

        if (!empty($validated['klasifikasi_subclasification'])) {
            $query->where('id_subklasifikasi', $validated['klasifikasi_subclasification']);
        } else {
            $query->whereNull('id_subklasifikasi');
        }

        if (!empty($validated['klasifikasi_subclasificationth'])) {
            $query->where('id_subklasifikasith', $validated['klasifikasi_subclasificationth']);
        } else {
            $query->whereNull('id_subklasifikasith');
        }

        $existingBook = $query->first();

        if (!$existingBook) {
            $BookData = [
                'tgl_masuk' => $validated['tgl_masuk'],
                'kategori' => $validated['kategori'],
                'judul' => $validated['judul'],
                'tahun' => $validated['tahun'],
                'penerbit' => $validated['penerbit'],
                'pengarang' => $validated['pengarang'],
                'eksemplar' => $validated['eksemplar'],
                'id_rak' => $validated['id_rak'],
                'id_jenis' => $validated['klasifikasi_jenis'],
                'id_mapel' => $validated['klasifikasi_mapel'],
            ];

            if (!empty($validated['klasifikasi_submapel'])) {
                $BookData['id_submapel'] = $validated['klasifikasi_submapel'];
            }

            if (!empty($validated['klasifikasi_subkelas'])) {
                $BookData['id_subkelas'] = $validated['klasifikasi_subkelas'];
            }

            if (!empty($validated['klasifikasi_subclasification'])) {
                $BookData['id_subklasifikasi'] = $validated['klasifikasi_subclasification'];
            }

            if (!empty($validated['klasifikasi_subclasificationth'])) {
                $BookData['id_subklasifikasith'] = $validated['klasifikasi_subclasificationth'];
            }

            $Book = EnrichmentBook::create($BookData);
            $nomorInduk = 1;

        } else {
            $lastNomorInduk = detailenrichmentbook::where('id_pengayaan', $existingBook->id)
                ->max('no_induk');

            $nomorInduk = $lastNomorInduk ? $lastNomorInduk + 1 : 1;
            $Book = $existingBook;
        }

        for ($i = 0; $i < $validated['eksemplar']; $i++) {
            detailenrichmentbook::create([
                'id_pengayaan' => $Book->id,
                'status_peminjaman' => 'available',
                'no_induk' => $nomorInduk + $i,
                'tgl_masuk' => $validated['tgl_masuk'],
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
        $enrichmentBooks = EnrichmentBook::with('detailEnrichmentBooks')->findOrFail($id);

        $bookcases = Bookcase::all();
        $types = BookType::all();
        $courses = Course::all();
        $subCourses = SubCourse::all();
        $subClasses = SubClass::all();
        $subClasification = SubClasification::all();
        $subClasificationTh = SubClasificationTh::all();


        return view('pengayaan.edit', compact('enrichmentBooks', 'bookcases', 'types', 'courses', 'subCourses', 'subClasses', 'subClasification', 'subClasificationTh'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $enrichmentBooks = EnrichmentBook::findOrFail($id);
        $validatedData = $request->validate([
            'tgl_masuk' => 'required|date',
            'kategori' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|numeric',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string',
            'id_rak' => 'required|exists:bookcases,id',
            'klasifikasi_jenis' => 'required|exists:type_books,id',
            'klasifikasi_mapel' => 'required|exists:courses,id',
            'klasifikasi_submapel' => 'nullable|exists:sub_courses,id',
            'klasifikasi_subkelas' => 'required|exists:sub_class,id',
            'klasifikasi_subclasification' => 'nullable|exists:sub_clasification,id',
            'klasifikasi_subclasificationth' => 'nullable|exists:sub_clasification4,id',
        ]);

        $BookData = [
            'judul' => $validatedData['judul'],
            'id_jenis' => $validatedData['klasifikasi_jenis'],
            'id_mapel' => $validatedData['klasifikasi_mapel'],
            'tgl_masuk' => $validatedData['tgl_masuk'],
            'tahun' => $validatedData['tahun'],
            'penerbit' => $validatedData['penerbit'],
            'id_rak' => $validatedData['id_rak'],
            'kategori' => $validatedData['kategori'],
            'pengarang' => $validatedData['pengarang'],
        ];


        if (!empty($validatedData['klasifikasi_submapel'])) {
            $BookData['id_submapel'] = $validatedData['klasifikasi_submapel'];
        }

        if (!empty($validatedData['klasifikasi_subkelas'])) {
            $BookData['id_subkelas'] = $validatedData['klasifikasi_subkelas'];
        }

        if (!empty($validatedData['klasifikasi_subclasification'])) {
            $BookData['id_subklasifikasi'] = $validatedData['klasifikasi_subclasification'];
        }

        if (!empty($validatedData['klasifikasi_subclasificationth'])) {
            $BookData['id_subklasifikasith'] = $validatedData['klasifikasi_subclasificationth'];
        }

        $enrichmentBooks->update($BookData);

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

    public function exportFile()
    {
        return Excel::download(new ExportDamagedEnrichmentBook, 'Buku Pengayaan Rusak.xlsx');
    }

    public function exportFileAllBooks()
    {
        return Excel::download(new ExportAllEnrichmentBook, 'Buku Pengayaan.xlsx');
    }




}
