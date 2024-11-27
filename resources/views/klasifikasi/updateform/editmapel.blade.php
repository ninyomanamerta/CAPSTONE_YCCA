@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-2">Update Mapel Buku</h1>
      <nav class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:history.back()">
                    <i class="bi bi-arrow-left-short" style="font-size: 20px"></i>
                    <span style="font-size: 20px">Kembali</span>
                </a>
            </li>
        </ol>
    </nav>

      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <div class="card">
        <div class="card-body">
            <h4 class="card-title ml-4 mb-6">Formulir Update Mapel Buku</h4>

          <!-- Horizontal Form -->
          <form action="{{ route('course.update', $course->id) }}" method="POST" class="px-3">
            @csrf
            @method('PUT')
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Mapel Buku</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="mapel" name="mapel" placeholder="Masukan mapel buku" required value="{{ old('mapel', $course->mapel) }}" >
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Induk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="noinduk" name="noinduk" placeholder="Masukan nomor induk" required value="{{ old('noinduk', $course->nomor_induk_mapel) }}">
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('course.index') }}" class="mt-2 btn btn-warning mb-2">Batal</a>
            </div>
          </form><!-- End Horizontal Form -->

        </div>
      </div>


    </div>
</section>
</main>


@endsection
