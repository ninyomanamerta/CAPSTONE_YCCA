@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-2">Merubah Data Siswa</h1>
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
          <form action="{{ route('student.update', $student->id) }}" method="POST" class="px-3">
            @csrf
            @method('PUT')
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">NIS Siswa</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukan NIS siswa" required value="{{ old('nis', $student->nis) }}">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Nama Siswa</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="namasiswa" name="namasiswa" placeholder="Masukan nama siswa" required value="{{ old('namasiswa', $student->nama_siswa) }}">
              </div>
            </div>

            <div class="form-group">
                <div class="row ">

                    <div class="form-group mb-2 col-5">
                        <label for="tingkat">Tingkat</label>
                    </div>
                    <div class="form-group mb-2 col-5" >
                        <label for="kelas">Kelas</label>
                    </div>
                    <div class="form-group mb-2 col-2" >
                        <label for="kelas">Kelas Saat Ini</label>
                    </div>

                </div>

                <ul class="list-group">
                    @foreach($student->detailSiswa as $detail)
                    <div class="row ">

                        <div class="form-group mb-2 col-5">
                            <input type="number" class="form-control mb-2" name="tingkat[]" value="{{ $detail->tingkat }}">
                        </div>

                        <div class="form-group mb-2 col-5">
                            <input type="text" class="form-control mb-2" name="kelas[]" value="{{ $detail->kelas }}">
                        </div>

                        <input type="hidden" name="detail_ids[]" value="{{ $detail->id }}">


                        <div class="form-group mb-2 col-3 mt-1">
                            <span class="student"><input type="checkbox" name="current_class[]" value="{{ $detail->id }}"></span>
                        </div>

                    </div>
                    @endforeach
                </ul>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('student.index') }}" class="mt-2 btn btn-warning mb-2">Batal</a>
            </div>
          </form><!-- End Horizontal Form -->

        </div>
      </div>


    </div>
</section>
</main>


@endsection
