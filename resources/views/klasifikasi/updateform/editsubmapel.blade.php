@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-4">Update Sub Mapel</h1>
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
            <h4 class="card-title ml-4 mb-6">Formulir Update Sub Mapel</h4>

          <!-- Horizontal Form -->
          <form action="{{ route('subCourse.update', $subCourse->id) }}" method="POST" class="px-3">
            @csrf
            @method('PUT')
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Sub Mapel</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="submapel" name="submapel" placeholder="Masukan sub mapel" required value="{{ old('submapel', $subCourse->sub_mapel) }}" >
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Induk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="noinduk" name="noinduk" placeholder="Masukan nomor induk" value="{{ old('noinduk', $subCourse->nomor_induk_submapel) }}">
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('subCourse.index') }}" class="mt-2 btn btn-warning mb-2">Batal</a>
            </div>
          </form><!-- End Horizontal Form -->

        </div>
      </div>


    </div>
</section>
</main>


@endsection
