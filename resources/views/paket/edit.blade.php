@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-2">Edit Data Buku Paket</h1>
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
            <h4 class="card-title ml-4 mb-6">Formulir Edit Buku Paket</h4>

          <!-- Horizontal Form -->
          <form action="{{ route('paket.update', $packageBook->id) }}" method="POST" class="px-3">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul" name="judul" required value="{{ old('judul', $packageBook->judul) }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="klasifikasi_jenis" class="col-sm-2 col-form-label">Klasifikasi Jenis</label>
                <div class="col-sm-10">
                    <select class="form-control" id="klasifikasi_jenis" name="klasifikasi_jenis" required>
                        <option value="">Pilih Jenis</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ old('klasifikasi_jenis', $packageBook->id_jenis) == $type->id ? 'selected' : '' }}>{{ $type->jenis_buku }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="klasifikasi_mapel" class="col-sm-2 col-form-label">Klasifikasi Mapel</label>
                <div class="col-sm-10">
                    <select class="form-control" id="klasifikasi_mapel" name="klasifikasi_mapel" required>
                        <option value="{{ $packageBook->mapel->mapel }}">Pilih Mata Pelajaran</option>
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('klasifikasi_mapel', $packageBook->id_mapel) == $course->id ? 'selected' : '' }}>{{ $course->mapel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="klasifikasi_submapel" class="col-sm-2 col-form-label">Klasifikasi Sub Mapel</label>
                <div class="col-sm-10">
                    <select class="form-control" id="klasifikasi_submapel" name="klasifikasi_submapel">
                        <option value="">Pilih Sub Mapel</option>
                        @foreach($subCourses as $subCourse)
                            <option value="{{ $subCourse->id }}" {{ old('klasifikasi_submapel', $packageBook->id_submapel) == $subCourse->id ? 'selected' : '' }}>{{ $subCourse->sub_mapel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="klasifikasi_subkelas" class="col-sm-2 col-form-label">Klasifikasi Sub Kelas</label>
                <div class="col-sm-10">
                    <select class="form-control" id="klasifikasi_subkelas" name="klasifikasi_subkelas" required>
                        <option value="">Pilih Sub Kelas</option>
                        @foreach($subClasses as $subClass)
                            <option value="{{ $subClass->id }}" {{ old('klasifikasi_subkelas', $packageBook->id_subkelas) == $subClass->id ? 'selected' : '' }}>{{ $subClass->sub_kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tgl_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="{{ old('tgl_masuk', $packageBook->tgl_masuk ? \Carbon\Carbon::parse($packageBook->tgl_masuk)->format('Y-m-d') : '') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required value="{{ old('tahun_terbit', $packageBook->tahun_terbit) }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="penerbit" name="penerbit" required value="{{ old('penerbit', $packageBook->penerbit) }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="sumber" class="col-sm-2 col-form-label">Sumber</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="sumber" name="sumber" required value="{{ old('sumber', $packageBook->sumber) }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required value="{{ old('jumlah', $packageBook->eksemplar) }}" readonly style="background-color: #adb5bd;">
                </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('paket.index') }}" class="mt-2 btn btn-warning mb-2">Batal</a>
            </div>
          </form><!-- End Horizontal Form -->

        </div>
      </div>

    </div>
</main>

@endsection
