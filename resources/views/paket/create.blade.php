@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-4">Tambah Data Buku Paket</h1>
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
            <h4 class="card-title ml-4 mb-6">Formulir Tambah Buku Paket</h4>

          <!-- Horizontal Form -->
          <form action="{{ route('paket.store') }}" method="POST" class="px-3">
            @csrf
            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul" name="judul" required value="{{ old('judul') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="klasifikasi_jenis" class="col-sm-2 col-form-label">Klasifikasi Jenis</label>
                <div class="col-sm-10">
                    <select class="form-control" id="klasifikasi_jenis" name="klasifikasi_jenis" required>
                        <option value="">Pilih Jenis</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->jenis_buku }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="klasifikasi_mapel" class="col-sm-2 col-form-label">Klasifikasi Mapel</label>
                <div class="col-sm-10">
                    <select class="form-control" id="klasifikasi_mapel" name="klasifikasi_mapel" required>
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->mapel }}</option>
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
                            <option value="{{ $subCourse->id }}">{{ $subCourse->sub_mapel }}</option>
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
                            <option value="{{ $subClass->id }}">{{ $subClass->sub_kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tgl_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" required value="{{ old('tgl_masuk') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required value="{{ old('tahun_terbit') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="penerbit" name="penerbit" required value="{{ old('penerbit') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="sumber" class="col-sm-2 col-form-label">Sumber</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="sumber" name="sumber" required value="{{ old('sumber') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required value="{{ old('jumlah') }}">
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