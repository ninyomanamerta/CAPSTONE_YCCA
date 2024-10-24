@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-4">Tambah Data Siswa</h1>


      <div class="card">
        <div class="card-body">
            <h4 class="card-title ml-4 mb-6">Formulir Tambah Data Siswa</h4>

          <!-- Horizontal Form -->
          <form class="px-3">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">NIS Siswa</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukan NIS siswa" >
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Nama Siswa</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="namasiswa" name="namasiswa" placeholder="Masukan nama siswa">
              </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukan kelas saat ini">
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
