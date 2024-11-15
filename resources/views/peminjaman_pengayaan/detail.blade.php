@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Peminjam Buku Fiksi/Non Fiksi</h1>

    <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
      <a href="" class="btn btn-primary">Pinjam Buku Pengayaan</a>
      </div>

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>

    <section class="section dashboard mt-4">
        <div class="row">
            <div class="col-12 px-3">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Peminjam Buku Fiksi/Non fiksi</h1>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tggl Peminjaman</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Nomor Induk Buku</th>
                                    <th>Judul Buku</th>
                                    <th>Mapel</th>
                                    <th style="display: flex; justify-content: flex-end;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>10/12/2022</td>
                                        <td>120221310</td>
                                        <td>Zamil Kebab</td>
                                        <td>12 IPA 2</td>
                                        <td>1332</td>
                                        <td>Matematika Alpro</td>
                                        <td>Matematika</td>
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
