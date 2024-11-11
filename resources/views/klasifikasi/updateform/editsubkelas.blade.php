@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-4">Update Sub Kelas</h1>
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
            <h4 class="card-title ml-4 mb-6">Formulir Update Sub Kelas</h4>

          <!-- Horizontal Form -->
          <form action="{{ route('class.update', $class->id) }}" method="POST" class="px-3">
            @csrf
            @method('PUT')
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Sub Kelas</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="subkelas" name="subkelas" placeholder="Masukan sub kelas" required value="{{ old('subkelas', $class->sub_kelas) }}">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Induk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="noinduk" name="noinduk" placeholder="Masukan nomor induk" required value="{{ old('noinduk', $class->nomor_induk_subkelas) }}">
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('class.index') }}" class="mt-2 btn btn-warning mb-2">Batal</a>
            </div>
          </form><!-- End Horizontal Form -->

        </div>
      </div>


    </div>
</section>
</main>


@endsection
