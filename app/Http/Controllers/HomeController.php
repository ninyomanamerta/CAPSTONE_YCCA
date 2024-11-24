<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPackageBook;
use App\Models\detailenrichmentbook;
use App\Models\DetailPeminjamanBukuPaket;
use App\Models\peminjaman_buku_pengayaan;
use App\Models\enrichmentbook;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // text chart
        $totalBukuPaket = DetailPackageBook::count();
        $bukuPaketRusak = DetailPackageBook::where('status_peminjaman', 'damaged')->count();
        $bukuPaketTersedia = DetailPackageBook::where('status_peminjaman', 'available')->count();
        $bukuPaketPinjam = DetailPackageBook::where('status_peminjaman', 'nonavailable')->count();
        $totalBukuPengayaan = detailenrichmentbook::count();
        $bukuPengayaanRusak = detailenrichmentbook::where('status_peminjaman', 'damaged')->count();
        $bukuPengayaanTersedia = detailenrichmentbook::where('status_peminjaman', 'available')->count();
        $bukuPengayaanPinjam = detailenrichmentbook::where('status_peminjaman', 'dipinjam')->count();

        // dought chart
        $totalPeminjaman = DetailPeminjamanBukuPaket::count();
        $statusBorrowed = DetailPeminjamanBukuPaket::where('status_peminjaman', 'borrowed')->count();
        $statusReturned = DetailPeminjamanBukuPaket::where('status_peminjaman', 'returned')->whereNull('keterangan')->count();
        $statusGantiBaru = DetailPeminjamanBukuPaket::where('status_peminjaman', 'returned')->where('keterangan', 'Ganti baru')->count();
        $today = Carbon::now();
        $totalPeminjamanPengayaan = peminjaman_buku_pengayaan::count();
        $terlambat = peminjaman_buku_pengayaan::where('status', 'dipinjam')->whereDate('tgl_pinjam', '<=', $today->subDays(7))->count();
        $sedangDiPinjam = peminjaman_buku_pengayaan::where('status', 'dipinjam')->where('tgl_pinjam', '>', $today->subDays(7))->count();
        $dikembalikan = peminjaman_buku_pengayaan::where('status', 'dikembalikan')->count();

        //Bar Chart
        $mostBorrowedBooks = DB::table('peminjaman_buku_pengayaan')
        ->join('enrichment_book', 'peminjaman_buku_pengayaan.id_judul_buku', '=', 'enrichment_book.id')
        ->select('enrichment_book.judul as book_title', DB::raw('COUNT(peminjaman_buku_pengayaan.id) as total_peminjaman'))
        ->groupBy('enrichment_book.judul')
        ->orderBy('total_peminjaman', 'desc')
        ->limit(7)
        ->get();

        //Line Chart
        $monthlyData = DB::table('peminjaman_buku_pengayaan')
        ->select(DB::raw('YEAR(tgl_pinjam) as year, MONTH(tgl_pinjam) as month, COUNT(*) as total_peminjaman'))
        ->groupBy(DB::raw('YEAR(tgl_pinjam), MONTH(tgl_pinjam)'))
        ->orderBy(DB::raw('YEAR(tgl_pinjam), MONTH(tgl_pinjam)'))
        ->get();



        return view('dashboard', compact('totalBukuPaket', 'bukuPaketRusak', 'bukuPaketTersedia', 'bukuPaketPinjam',
        'totalBukuPengayaan', 'bukuPengayaanRusak', 'bukuPengayaanTersedia', 'bukuPengayaanPinjam',
        'statusBorrowed', 'statusReturned', 'statusGantiBaru', 'totalPeminjaman', 'totalPeminjamanPengayaan', 'sedangDiPinjam',
        'terlambat', 'dikembalikan', 'mostBorrowedBooks', 'monthlyData'));



    }
}
