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
                    <i class="bi bi-person-square" style="font-size: 60px; color: #798eb3;"></i>
                  </div>
                  <!-- Kolom untuk teks -->
                  <div class="col-4 mt-3 mb-2">
                    <h5 class="sub-title">Nama : Moana</h5>
                    <h5 class="sub-title">NIS : 1202210259</h5>
                    <h5 class="sub-title">Kelas Saat Ini : 7A</h5>
                  </div>
                  <div class="col-6 mt-3">
                    <h5 class="sub-title">Total Buku Yang Dipinjam : 10</h5>
                    <h5 class="sub-title">Total Buku Yang Dikembalikan : 0</h5>
                 </div>
                </div>
            </div>
        </div><!-- End Default Card -->
    </section>

    {{-- Kelas 7 --}}
    <section class="section dashboard mt-4">
        <div class="row">
            <div class="col-12 px-3">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Peminjaman Buku Paket Kelas : 7A</h1>

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
                                    <tr>
                                        <td>1</td>
                                        <td>10/12/2022</td>
                                        <td>Matematika Alpro</td>
                                        <td>202020</td>
                                        <td><a href="#" class="badge bg-success">Dipinjam</a></td>
                                        <th>-</th>
                                        <th>-</th>
                                        <td>
                                        <a href="" class="badge bg-warning">Update</a>
                                        <form action="" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Yakin ingin menghapus Data peminjaman ini?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Kelas 8 --}}
    <section class="section dashboard mt-4">
        <div class="row">
            <div class="col-12 px-3">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Peminjaman Buku Paket Kelas : 8</h1>

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
                                    <tr>
                                        <td>1</td>
                                        <td>10/12/2022</td>
                                        <td>Matematika Alpro</td>
                                        <td>202020</td>
                                        <td><a href="#" class="badge bg-success">Dipinjam</a></td>
                                        <th>-</th>
                                        <th>-</th>
                                        <td>
                                        <a href="" class="badge bg-warning">Update</a>
                                        <form action="" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Yakin ingin menghapus Data peminjaman ini?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Kelas 9 --}}
    <section class="section dashboard mt-4">
        <div class="row">
            <div class="col-12 px-3">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Peminjaman Buku Paket Kelas : 9</h1>

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
                                    <tr>
                                        <td>1</td>
                                        <td>10/12/2022</td>
                                        <td>Matematika Alpro</td>
                                        <td>202020</td>
                                        <td><a href="#" class="badge bg-success">Dipinjam</a></td>
                                        <th>-</th>
                                        <th>-</th>
                                        <td>
                                        <a href="" class="badge bg-warning">Update</a>
                                        <form action="" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Yakin ingin menghapus Data peminjaman ini?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>



</main>

@endsection
