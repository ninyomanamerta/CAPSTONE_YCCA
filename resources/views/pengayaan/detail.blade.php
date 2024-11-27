@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-2">Detail Data Buku Pengayaan</h1>
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


        <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
            <a href="{{ route('enrichmentBooks.create') }}" class="btn btn-primary">Tambah Buku Pengayaan</a>
        </div>

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
                <h5 class="card-title2">{{ $enrichmentBooks->judul }}</h5>
                <div class="row">
                  <!-- Kolom untuk ikon -->
                  <div class="col-1 d-flex align-items-start mt-1">
                    <i class="bi bi-journal-bookmark" style="font-size: 60px; color: #798eb3;"></i>
                  </div>
                  <!-- Kolom untuk teks -->
                  <div class="col-4 mt-3 mb-2">
                    <h5 class="sub-title">Tahun Terbit : {{ $enrichmentBooks->tahun }}</h5>
                    <h5 class="sub-title">Pengarang : {{ $enrichmentBooks->pengarang }}</h5>
                    <h5 class="sub-title">Penerbit : {{ $enrichmentBooks->penerbit }}</h5>
                  </div>
                  <div class="col-6 mt-3">
                    <h5 class="sub-title">Tanggal Masuk : {{ \Carbon\Carbon::parse($enrichmentBooks->tgl_masuk)->format('d M Y') }}</h5>
                    <h5 class="sub-title">Eksemplar : {{ $enrichmentBooksCount->detail_enrichment_books_count }} <span>| Dipinjam : {{ $jumlahDipinjam }}</span></h5>
                    <h5 class="sub-title">Rak : {{ $enrichmentBooks->bookcase->lokasi }} <span>| {{ $enrichmentBooks->bookcase->keterangan }}</span></h5>
                  </div>
                </div>
            </div>
        </div><!-- End Default Card -->
    </section>


    <section class="section dashboard">
        <div class="row">
            <div class="col-12 px-3">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Detail Buku Pengayaan</h1>
                        {{-- <h5 class="card-body px-2">Judul : {{ $enrichmentBooks->judul }}</h5> --}}

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Nomor Induk</th>
                                    <th>Rak</th>
                                    <th>Status</th>
                                    <th style="display: flex; justify-content: flex-end;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrichmentBooks->detailEnrichmentBooks as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($enrichmentBooks->judul, 50, '...') }}</td>
                                        <td>{{ str_pad($detail->no_induk, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $enrichmentBooks->bookcase->lokasi }}</td>
                                        <td>
                                            @if($detail->status_peminjaman === 'available')
                                                <a href="#" class="badge bg-success">Available</a>
                                            @elseif ($detail->status_peminjaman === 'damaged')
                                                <a href="#" class="badge bg-danger">Buku Rusak</a>
                                            @else
                                                <a href="#" class="badge bg-secondary">No Available</a>
                                            @endif
                                          </td>
                                        <td>
                                            <button type="button" class="badge bg-warning" style="border: none;" data-bs-toggle="modal" data-bs-target="#updateStatusModal"
                                                data-id="{{ $detail->id }}" data-status="{{ $detail->status_peminjaman }}">
                                                Ubah Status
                                            </button>
                                            {{-- <a href="{{ route('enrichmentbooks.show', $book->id) }}" class="badge bg-success">View</a> --}}
                                            {{-- <a href="{{ route('enrichmentBooks.edit', $book->id) }}" class="badge bg-warning">Update</a> --}}
                                            <form action="{{ route('enrichmentBooks.destroyDetail', $detail->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Yakin ingin menghapus buku ini?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Modal -->
                    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('enrichmentBooks.updateStatus') }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="updateStatusModalLabel">Ubah Status Buku</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <input type="hidden" name="id" id="book-id">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control" name="status" id="status">
                                        <option value="available">Tidak Rusak</option>
                                        <option value="damaged">Rusak</option>
                                        <option value="nonavailable">No Available</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        const updateStatusModal = document.getElementById('updateStatusModal');
                        updateStatusModal.addEventListener('show.bs.modal', (event) => {
                        const button = event.relatedTarget;
                        const bookId = button.getAttribute('data-id');
                        const status = button.getAttribute('data-status');

                        const modalBookId = updateStatusModal.querySelector('#book-id');
                        const modalStatus = updateStatusModal.querySelector('#status');

                        modalBookId.value = bookId;
                        modalStatus.value = status;
                        });
                    </script>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
