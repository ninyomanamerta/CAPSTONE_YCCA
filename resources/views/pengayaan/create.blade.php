@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-2">Tambah Data Buku Pengayaan</h1>
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
                <h4 class="card-title ml-4 mb-6">Formulir Tambah Buku Pengayaan</h4>

                <!-- Horizontal Form -->
                <form action="{{ route('enrichmentBooks.store') }}" method="POST" class="px-3">
                    @csrf

                    <div class="row mb-3">
                        <label for="tgl_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" required value="{{ old('tgl_masuk') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pengarang" name="pengarang" required value="{{ old('pengarang') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul" name="judul" required value="{{ old('judul') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="penerbit" name="penerbit" required value="{{ old('penerbit') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                        <div class="col-sm-10">
                            <input type="integer" class="form-control" id="tahun" name="tahun" required value="{{ old('tahun') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jumlah" class="col-sm-2 col-form-label">Eksemplar</label>
                        <div class="col-sm-10">
                            <input type="integer" class="form-control" id="eksemplar" name="eksemplar" required value="{{ old('eksemplar') }}">
                        </div>
                    </div>

                    <!-- Dropdown untuk memilih Rak -->
                    <div class="row mb-3">
                        <label for="id_rak" class="col-sm-2 col-form-label">Rak</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_rak" name="id_rak" required>
                                <option value="">Pilih Rak</option>
                                @foreach($bookcases as $bookcase)
                                    <option value="{{ $bookcase->id }}" {{ old('id_rak') == $bookcase->id ? 'selected' : '' }}>
                                        Rak {{ $bookcase->lokasi ?? 'Nama Rak Tidak Tersedia' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('enrichmentBooks.index') }}" class="mt-2 btn btn-warning mb-2">Batal</a>
                    </div>
                </form><!-- End Horizontal Form -->

            </div>
        </div>

    </div>
</main>

@endsection
