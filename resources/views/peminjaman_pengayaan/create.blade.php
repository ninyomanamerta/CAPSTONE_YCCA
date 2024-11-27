@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-2">Tambah Peminjaman Buku Pengayaan</h1>
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
                <h4 class="card-title ml-4 mb-6">Formulir Pinjam Buku Pengayaan</h4>

                <!-- Horizontal Form -->
                <form action="{{ route('peminjamanbukupengayaan.store') }}" method="POST" class="px-3">
                    @csrf

                    <div class="row mb-3">
                        <label for="id_siswa" class="col-sm-2 col-form-label">Nama Siswa</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_siswa" name="id_siswa" required>
                                <option value="">Pilih Siswa</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('id_siswa') == $student->id ? 'selected' : '' }}>
                                        {{ $student->nama_siswa}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Dropdown Buku yang Dipinjam -->
                    <div class="row mb-3">
                        <label for="id_judul_buku" class="col-sm-2 col-form-label">Judul Buku yang Dipinjam</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_judul_buku" name="id_judul_buku" required>
                                <option value="">Pilih Buku</option>
                                @foreach ($judulbuku as $judul)
                                    <option value="{{ $judul->id }}" {{ old('id_judul_buku') == $judul->id ? 'selected' : '' }}>
                                        {{ $judul->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Nomor Buku yang Tersedia -->
                    <div class="row mb-3">
                        <label for="id_detail_buku" class="col-sm-2 col-form-label">Nomor Buku yang Tersedia</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_detail_buku" name="id_detail_buku" required>
                                <option value="">Pilih Nomor Buku</option>
                                <!-- Options akan dimuat secara dinamis -->
                            </select>
                        </div>
                    </div>

                    <!-- Nama yang Memberikan Pinjaman -->
                    <div class="row mb-3">
                        <label for="peminjam" class="col-sm-2 col-form-label">Nama yang Memberikan Pinjaman</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="peminjam" name="peminjam" required value="{{ old('peminjam') }}">
                        </div>
                    </div>

                    <!-- Tanggal Pinjam -->
                    <div class="row mb-3">
                        <label for="tgl_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm-10">
                            <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" required value="{{ old('tgl_pinjam') }}">
                        </div>
                    </div>

                    <!-- Tanggal Pengembalian -->
                    <div class="row mb-3">
                        <label for="tgl_pengembalian" class="col-sm-2 col-form-label">Tanggal Pengembalian</label>
                        <div class="col-sm-10">
                            <input type="date" name="tgl_pengembalian" id="tgl_pengembalian" class="form-control" required value="{{ old('tgl_pengembalian') }}">
                        </div>
                    </div>

                    <!-- Status -->
                    <input type="hidden" name="status" value="dipinjam">

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('peminjamanbukupengayaan.index') }}" class="mt-2 btn btn-warning mb-2">Batal</a>
                    </div>
                </form><!-- End Horizontal Form -->

            </div>
        </div>

    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_judul_buku').on('change', function() {
            var judulId = $(this).val();

            // Kosongkan dropdown kedua
            $('#id_detail_buku').html('<option value="">Pilih Buku</option>');

            if (judulId) {
                // AJAX untuk memuat data buku berdasarkan idBuku
                $.ajax({
                    url: '/get-books/' + judulId, // Pastikan URL sesuai dengan route Anda
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(index, book) {
                                // Format nomor buku menjadi 4 digit menggunakan padStart
                                var formattedNumber = book.no_induk.toString().padStart(4, '0');
                                $('#id_detail_buku').append('<option value="' + book.id + '">' + formattedNumber + '</option>');
                            });
                        } else {
                            $('#id_detail_buku').html('<option value="">Tidak ada buku tersedia</option>');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat mengambil data.');
                    }
                });
            }
        });
    });
</script>




@endsection
