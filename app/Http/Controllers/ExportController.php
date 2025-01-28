<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportStudent;
use App\Exports\ExportPeminjamanPaket;
use App\Exports\ExportPeminjamanPengayaan;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function test()
    {
        die;
    }

    public function exportStudent()
    {
        //die;
        return Excel::download(new ExportStudent, 'Data Siswa.xlsx');
    }

    public function exportPeminjamanPaket()
    {
        //die;
        return Excel::download(new ExportPeminjamanPaket, 'Data Peminjaman Buku Paket.xlsx');
    }

    public function exportPeminjamanPengayaan()
    {
        //die;
        return Excel::download(new ExportPeminjamanPengayaan, 'Data Peminjaman Buku Pengayaan.xlsx');
    }
}
