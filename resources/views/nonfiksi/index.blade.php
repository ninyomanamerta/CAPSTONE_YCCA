@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Data Buku Nonfiksi</h1>
      
      <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
      <a href="" class="btn btn-primary">Tambah Buku Non-FIksi</a>
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
            <h1 class="card-title px-2" style="font-size: 16px">Daftar Buku Non-Fiksi</h1>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Masuk</th>
                    <th>Pengarang</th>
                    <th>Judul</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Jumlah</th>
                    <th style="display: flex; justify-content: flex-end;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>1</td>
                      <td>07 Desember 2023</td>
                      <td>PEP</td>
                      <td>Alpro</td>
                      <td>Reza</td>
                      <td>2002</td>
                      <td>6</td>
                      <td>
                        <a href="" class="badge bg-success">View</a>
                        <a href="" class="badge bg-warning">Update</a>
                        <form action="" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Yakin ingin menghapus buku ini?');">Delete</button>
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
