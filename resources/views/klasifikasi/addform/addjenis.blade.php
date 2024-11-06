@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-4">Tambah Jenis Buku</h1>


      <div class="card">
        <div class="card-body">
            <h4 class="card-title ml-4 mb-6">Formulir Tambah Jenis Buku</h4>

          <!-- Horizontal Form -->
          <form class="px-3">
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Buku</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Masukan jenis buku" >
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Induk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="noinduk" name="noinduk" placeholder="Masukan nomor induk">
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End Horizontal Form -->

        </div>
      </div>


    </div>
</section>
</main>


@endsection
