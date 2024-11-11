@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-4">Merubah Data Rak</h1>
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      {{-- <nav>
        <ol class="breadcrumb text-bold mt-1">
            <li class="breadcrumb-item active"><a href="" style="color: #1c1b1a; font-weight: bold; font-size:15px;"><b>Semua Siswa</b></a></li>
            <li class="breadcrumb-item active"><a href="">Kelas 7</a></li>
            <li class="breadcrumb-item active"><a href="">Kelas 8</a></li>
            <li class="breadcrumb-item active"><a href="">Kelas 9</a></li>
        </ol>
      </nav> --}}

      <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
      <a href="" class="btn btn-primary">Tambah Rak</a>
      </div>
      {{-- </div>
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert" style="padding-top:10px">
            {{ Session::get('success') }}
        </div>
        @endif --}}

    </div><!-- End Page Title -->
    <section class="section dashboard mt-4">
      <div class="row">

        <div class="col-12 px-3">
          <div class="card recent-sales overflow-auto">

            <div class="card-body">
              <h1 class="card-title px-2" style="font-size: 16px">Daftar Rak Penyimpanan</h1>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Lokasi Rak</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tgl Ditambahkan</th>
                    <th scope="col" style="display: flex; justify-content: flex-end;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                {{-- looping row --}}
                  <tr>
                    <th scope="row" class="col">1</th>
                    <td class="col">1A</td>
                    <td class="col">Rak pertama</td>
                    <td class="col-1">12-10-2024</td>
                    <td class="col" style="display: flex; justify-content: flex-end;">
                        <a href=""><span class="badge bg-success">View</span></a>
                        <a href=""><span class="badge bg-warning">Update</span></a>
                        <a href=""><span class="badge bg-danger">Delete</span></a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row" class="col-1">2</th>
                    <td class="col-2">1B</td>
                    <td class="col-1">Rak kedua </td>
                    <td class="col-1">12-10-2024</td>
                    <td class="col-0" style="display: flex; justify-content: flex-end;">
                        <a href=""><span class="badge bg-success">View</span></a>
                        <a href=""><span class="badge bg-warning">Update</span></a>
                        <a href=""><span class="badge bg-danger">Delete</span></a>
                    </td>
                  </tr>

                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->


      </div>
    </section>
</main>

@endsection
