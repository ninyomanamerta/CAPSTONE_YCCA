@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-4">Tambah Jenis Buku</h1>

      <div class="card">
        <div class="card-body">
            <h4 class="card-title ml-4 mb-6">Formulir Tambah Jenis Buku</h4>

          <!-- Horizontal Form -->
          <form action="{{ route('jenis.store') }}" method="POST" class="px-3">
            @csrf  <!-- CSRF Token -->

            <div class="row mb-3">
              <label for="jenis" class="col-sm-2 col-form-label">Jenis Buku</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="jenis" name="jenis_buku" placeholder="Masukan jenis buku" required value="{{ old('jenis_buku') }}">
              </div>
            </div>

            <div class="row mb-3">
              <label for="noinduk" class="col-sm-2 col-form-label">Nomor Induk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="noinduk" name="nomor_induk_jenis" placeholder="Masukan nomor induk" required value="{{ old('nomor_induk_jenis') }}">
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('jenis.index') }}" class="mt-2 btn btn-warning mb-2">Batal</a>
            </div>
          </form><!-- End Horizontal Form -->

        </div>
      </div>
    </div>
</main>

@endsection
