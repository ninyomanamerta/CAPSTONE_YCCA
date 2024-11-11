@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Data Buku Paket</h1>

      <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
      <a href="" class="btn btn-primary">Tambah Buku Paket</a>
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
            <h1 class="card-title px-2" style="font-size: 16px">Daftar Buku Paket</h1>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Masuk</th>
                    <th>Judul</th>
                    <th>Tahun Terbit</th>
                    <th>Penerbit</th>
                    <th>Eksemplar</th>
                    <th>Sumber</th>
                    <th style="display: flex; justify-content: flex-end;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>1</td>
                      <td>07 Desember 2023</td>
                      <td>Matematika</td>
                      <td>2020</td>
                      <td>Reza Publisher</td>
                      <td>6</td>
                      <td>Pemerintah</td>
                      <td>
                        <a href="" class="badge bg-success">Detail</a>
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
