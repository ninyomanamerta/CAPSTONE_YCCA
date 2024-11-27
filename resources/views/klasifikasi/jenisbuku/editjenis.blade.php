@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-2">Merubah Data Jenis Buku</h1>
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
            <h4 class="card-title ml-4 mb-6">Formulir Edit Data Siswa</h4>

          <!-- Horizontal Form -->
          <form action="{{ route('jenis.update', $jenis->id) }}" method="POST" class="px-3">
            @csrf
            @method('PUT')
            <div class="row mb-3">
              <label for="jenis" class="col-sm-2 col-form-label">Jenis Buku</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="jenis" name="jenis_buku" placeholder="Masukan jenis buku" required value="{{ old('jenis_buku', $jenis->jenis_buku) }}">
              </div>
            </div>
            <div class="row mb-3">
              <label for="noinduk" class="col-sm-2 col-form-label">Nomor Induk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="noinduk" name="nomor_induk_jenis" placeholder="Masukan nomor induk" required value="{{ old('nomor_induk_jenis', $jenis->nomor_induk_jenis) }}">
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
</section>
</main>


@endsection
