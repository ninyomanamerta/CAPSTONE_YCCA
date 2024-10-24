@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-4">Tambah Data Rak</h1>


      <div class="card">
        <div class="card-body">
            <h4 class="card-title ml-4 mb-6">Formulir Tambah Data Rak</h4>

          <!-- Horizontal Form -->
          <form class="px-3">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Lokasi rak</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukan lokasi rak" >
              </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Jelaskan lokasi rak" rows="3"></textarea>
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
