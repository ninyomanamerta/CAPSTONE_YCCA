@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Detail Data Buku Pengayaan</h1>

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
                                            @else
                                                <a href="#" class="badge bg-secondary">No Available</a>
                                            @endif
                                          </td>
                                        <td>
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

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
