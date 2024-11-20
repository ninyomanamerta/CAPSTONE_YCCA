@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-4">Pengembalian Buku Paket</h1>
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
                <h4 class="card-title ml-4 mb-6">Formulir Pengembalian Buku Paket</h4>

                <!-- Horizontal Form -->
                <form action="{{ route('pinjamPaket.updateStatus', $peminjamanPaket->id) }}" method="POST" class="px-3">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="student" value="{{ $peminjamanPaket->siswa->id }}">

                    {{-- Penanggung Jawab --}}
                    <div class="row mb-3">
                        <label for="pic" class="col-sm-2 col-form-label">Peminjaman</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control readonly" id="pic" name="pic" placeholder="Petugas yang meminjamkan buku" value="{{ old('pic', $peminjamanPaket->penanggung_jawab) }}" readonly required >
                        </div>
                    </div>

                    {{-- Stundet --}}
                    <div class="row mb-3">
                        <label for="student" class="col-sm-2 col-form-label">Data Siswa</label>
                        <div class="col-sm-10 ">
                            <input type="text" class="form-control readonly" name="studentAs" value="{{ $peminjamanPaket->kelas }} | {{ $peminjamanPaket->siswa->nis }} | {{ $peminjamanPaket->siswa->nama_siswa }}" readonly>
                        </div>
                    </div>

                    {{-- Penanggung Jawab Pengembalian--}}
                    <div class="row mb-5">
                        <label for="pic" class="col-sm-2 col-form-label">Pengembalian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pic-return" name="pic-return" placeholder="Petugas yang menerima pengembalian buku" value="{{ old('pic-return', $peminjamanPaket->pengembalian) }}" required >
                        </div>
                    </div>

                    {{-- Data Buku Lama --}}
                    <div class="form-group">
                        <div class="row ">

                            <div class="form-group mb-2 col-5">
                                <label for="book-old">Buku Paket</label>
                            </div>
                            <div class="form-group mb-2 col-4" >
                                <label for="status">Pilih Status Pengembalian</label>
                            </div>
                            <div class="form-group mb-2 col-4">
                                <label for="keterangan">Keterangan</label>
                            </div>
                        </div>

                        <ul class="list-group">
                            @foreach($peminjamanPaket->detailPeminjamanBukuPaket as $detail)
                            <div class="row ">

                                <div class="form-group mb-2 col-5">
                                    <input type="text" class="form-control mb-2 readonly" name="books-old" value="{{ $detail->bukuPaket->packageBook->judul }} | {{ $detail->bukuPaket->packageBook->jenis->nomor_induk_jenis }}{{ $detail->bukuPaket->packageBook->mapel->nomor_induk_mapel }}{{ $detail->bukuPaket->packageBook->submapel->nomor_induk_submapel }}{{ $detail->bukuPaket->packageBook->subkelas->nomor_induk_subkelas }}.{{ str_pad($detail->bukuPaket->nomor_induk, 4, '0', STR_PAD_LEFT) }}" readonly>
                                </div>

                                <div class="form-group mb-2 col-4" >
                                    <select class="form-control" name="status[{{ $detail->id }}]" id="status-{{ $detail->id }}">
                                        <option value="borrowed" {{ $detail->status_peminjaman == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                                        <option value="returned" {{ $detail->status_peminjaman == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <input type="text" class="form-control" name="keterangan[{{ $detail->id }}]" id="keterangan-{{ $detail->id }}" value="{{ old('keterangan.' . $detail->id,  $detail->keterangan) }}" placeholder="Opsional...">
                                </div>
                            </div>
                            @endforeach
                        </ul>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pinjamPaket.detail', $peminjamanPaket->siswa->id) }}" class="mt-2 btn btn-warning mb-2">Batal</a>
                    </div>
                </form><!-- End Horizontal Form -->

            </div>
        </div>
    </div>

</main>

@endsection


