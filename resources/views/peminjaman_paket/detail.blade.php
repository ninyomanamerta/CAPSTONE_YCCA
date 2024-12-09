@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-2">Data Peminjam Buku Paket</h1>

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


        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>

    <!-- Default Card -->
    <section class="section dashboard">
        <div class="card mt-8 mb-3 col-12 px-3">
            <div class="card-body">
                <h5 class="card-title2">Data Siswa</h5>
                <div class="row">
                  <!-- Kolom untuk ikon -->
                  <div class="col-1 d-flex align-items-start mt-1">
                    <i class="bi bi-person-square" style="font-size: 50px; color: #798eb3;"></i>
                  </div>
                  <!-- Kolom untuk teks -->
                  <div class="col-5 mt-3 mb-2 mt-4">
                    <h5 class="sub-title">Nama : {{ $student->nama_siswa }}</h5>
                  </div>
                  <div class="col-3 mt-3 mb-2 mt-4">
                    <h5 class="sub-title">NIS : {{ $student->nis }}</h5>
                  </div>
                  <div class="col-3 mt-3 mb-2 mt-4">
                    <h5 class="sub-title">Kelas Saat Ini :
                        @if ($currentClassDetail = $student->detailSiswa->where('current_class', true)->first())
                            {{ $currentClassDetail->tingkat }}{{ $currentClassDetail->kelas }}
                        @else
                            Tidak ada kelas aktif
                        @endif
                    </h5>
                  </div>

                </div>
            </div>
        </div><!-- End Default Card -->
    </section>

    @foreach ($peminjamanByClassLevels as $classLevel => $peminjamanList)
    <section class="section dashboard mt-4">
        <div class="row">
            <div class="col-12 px-3">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Peminjaman Buku Paket Kelas: {{ $classLevel }} <span> |
                            @php
                               $kelasCollection = $peminjamanList->pluck('kelas')->unique();
                            @endphp
                                {{ $kelasCollection->implode(', ') }} </span>
                        </h1>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Judul Buku</th>
                                    <th>No Induk</th>
                                    <th>Status</th>
                                    <th>Tgl Kembali</th>
                                    <th>Keterangan</th>
                                    <th style="display: flex; justify-content: flex-end;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peminjamanList as $peminjaman)
                                @php
                                    $peminjamanId = $peminjaman->id;
                                @endphp
                                    @foreach ($peminjaman->detailPeminjamanBukuPaket as $index => $detail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($detail->tanggal_pinjam)->format('d/m/Y') }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($detail->bukuPaket->packageBook->judul, 20, '...') }}</td>
                                            <td>
                                                {{ $detail->bukuPaket->packageBook->jenis->nomor_induk_jenis }}{{ $detail->bukuPaket->packageBook->mapel->nomor_induk_mapel }}{{ optional($detail->bukuPaket->packageBook->submapel)->nomor_induk_submapel }}{{ optional($detail->bukuPaket->packageBook->subkelas)->nomor_induk_subkelas }}{{ optional($detail->bukuPaket->packageBook->subklasifikasi)->nomor_induk_klasifikasi }}{{ optional($detail->bukuPaket->packageBook->subklasifikasith)->nomor_induk_klasifikasi4 }}.{{ str_pad($detail->bukuPaket->nomor_induk, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>
                                                <a href="#" class="badge {{ $detail->status_peminjaman == 'borrowed' ? 'bg-secondary' : 'bg-success' }}">
                                                    {{ $detail->status_peminjaman }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $detail->status_peminjaman == 'returned' ? $detail->updated_at->format('d/m/Y') : '-' }}
                                            </td>
                                            <td>{{ \Illuminate\Support\Str::limit($detail->keterangan ?? '-', 15, '...') }}</td>
                                            <td>
                                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal" data-id="{{ $detail->id }}" class="view-detail"><span class="badge bg-success">Detail</span> --}}

                                                <form action="{{ route('pinjamPaket.destroyBook', $detail->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Yakin ingin menghapus Data peminjaman ini?');">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <a href="{{ route('pinjamPaket.edit', $peminjamanId) }}" class="btn btn-primary ml-2 mb-3">Tambah Buku</a>
                                    <span><a href="{{ route('pinjamPaket.status', $peminjamanId) }}" class="btn btn-warning ml-2 mb-3">Pengembalian Buku</a></span>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Peminjaman Buku Paket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Judul Buku:</strong> <span id="modal-detail"></span></p>
                <p><strong>No Induk:</strong> <span id="modal-noinduk"></span></p>
                <p><strong>Tanggal Pinjam:</strong> <span id="modal-tanggal"></span></p>
                <p><strong>Tanggal Kembali:</strong> <span id="modal-tanggal-update"></span></p>
                <p><strong>Keterangan:</strong> <span id="modal-keterangan"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script>
    $('.view-detail').on('click', function() {
    var peminjamanId = $(this).data('id');

    // Menampilkan loading message
    $('#modal-detail').text('Loading...');
    $('#modal-noinduk').text('Loading...');
    $('#modal-tanggal').text('Loading...');
    $('#modal-tanggal-update').text('Loading...');
    $('#modal-keterangan').text('Loading...');

    $.ajax({
        url: '/pinjamPaket/modal/' + peminjamanId,
        method: 'GET',
        success: function(data) {

            var detail = data.detailPeminjamanBukuPaket;

            $('#modal-detail').text(detail.buku_paket.package_book.judul);
            $('#modal-noinduk').text(detail.buku_paket.nomor_induk);

            const options = {year: 'numeric', month: 'long', day: 'numeric'};

            const createdDate = new Date(detail.tanggal_pinjam);
            $('#modal-tanggal').text(createdDate.toLocaleDateString(undefined, options));

            const updatedDate = new Date(detail.updated_at);
            $('#modal-tanggal-update').text(updatedDate.toLocaleDateString(undefined, options));

            $('#modal-keterangan').text(detail.keterangan || '-');


            $('#detailModal').modal('show');
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert('Terjadi kesalahan saat memuat data. Status: ' + xhr.status);
        }
    });
});
</script>



</main>

@endsection
