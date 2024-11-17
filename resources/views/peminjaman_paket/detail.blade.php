@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Peminjam Buku Paket</h1>

      <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
      <a href="" class="btn btn-primary">Pinjam Buku Paket</a>
      </div>

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>

    <!-- Default Card -->
    <section class="section dashboard">
        <div class="card mt-8 mb-3 col-12 px-3">
            <div class="card-body">
                <h5 class="card-title2">Data Siswa</h5>
                <div class="row">
                  <!-- Kolom untuk ikon -->
                  <div class="col-1 d-flex align-items-start mt-1">
                    <i class="bi bi-person-square" style="font-size: 50px; color: #798eb3;"></i>
                  </div>
                  <!-- Kolom untuk teks -->
                  <div class="col-5 mt-3 mb-2 mt-4">
                    <h5 class="sub-title">Nama : {{ $student->nama_siswa }}</h5>
                  </div>
                  <div class="col-3 mt-3 mb-2 mt-4">
                    <h5 class="sub-title">NIS : {{ $student->nis }}</h5>
                  </div>
                  <div class="col-3 mt-3 mb-2 mt-4">
                    <h5 class="sub-title">Kelas Saat Ini : {{ $student->kelas }}</h5>
                  </div>

                </div>
            </div>
        </div><!-- End Default Card -->
    </section>

    @foreach ($peminjamanByClassLevels as $classLevel => $peminjamanList)
    <section class="section dashboard mt-4">
        <div class="row">
            <div class="col-12 px-3">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Peminjaman Buku Paket Kelas: {{ $classLevel }} <span> |
                            @php
                               $kelasCollection = $peminjamanList->pluck('kelas')->unique();
                            @endphp
                                {{ $kelasCollection->implode(', ') }} </span></h1>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Judul Buku</th>
                                    <th>No Induk</th>
                                    <th>Status</th>
                                    <th>Tgl Kembali</th>
                                    <th>Keterangan</th>
                                    <th style="display: flex; justify-content: flex-end;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peminjamanList as $peminjaman)
                                    @foreach ($peminjaman->detailPeminjamanBukuPaket as $index => $detail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $peminjaman->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $detail->bukuPaket->packageBook->judul }}</td>
                                            <td>{{ $detail->bukuPaket->packageBook->jenis->nomor_induk_jenis }}{{ $detail->bukuPaket->packageBook->mapel->nomor_induk_mapel }}{{ $detail->bukuPaket->packageBook->submapel->nomor_induk_submapel }}{{ $detail->bukuPaket->packageBook->subkelas->nomor_induk_subkelas }}.{{ str_pad($detail->bukuPaket->nomor_induk, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td><a href="#" class="badge bg-success">{{ $detail->status_peminjaman }}</a></td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>
                                                <a href="#" class="badge bg-warning">Update</a>
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Yakin ingin menghapus Data peminjaman ini?');">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    {{-- <tr>
                                        <td colspan="8">Tidak ada data peminjaman untuk kelas {{ $classLevel }}</td>
                                    </tr> --}}
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach


</main>

@endsection
