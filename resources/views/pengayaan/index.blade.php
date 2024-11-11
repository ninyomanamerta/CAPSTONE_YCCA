@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Buku Pengayaan</h1>
        
        <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
            <a href="{{ route('enrichmentBooks.create') }}" class="btn btn-primary">Tambah Buku Pengayaan</a>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>

    <section class="section dashboard mt-4">
        <div class="row">
            <div class="col-12 px-3">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Buku Pengayaan</h1>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Pengarang</th>
                                    <th>Judul</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Jumlah</th>
                                    <th>Rak</th>
                                    <th style="display: flex; justify-content: flex-end;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrichmentBooks as $index => $book)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $book->tgl_masuk }}</td>
                                        <td>{{ $book->pengarang }}</td>
                                        <td>{{ $book->judul }}</td>
                                        <td>{{ $book->penerbit ?? '-' }}</td> <!-- Pastikan kolom ini ada di database jika diperlukan -->
                                        <td>{{ $book->tahun }}</td>
                                        <td>{{ $book->eksemplar }}</td>
                                        <td>{{ $book->bookcase->lokasi ?? '-' }}</td> <!-- Sesuaikan dengan relasi ke Bookcase -->
                                        <td>
                                            {{-- <a href="{{ route('enrichmentbooks.show', $book->id) }}" class="badge bg-success">View</a> --}}
                                            <a href="{{ route('enrichmentBooks.edit', $book->id) }}" class="badge bg-warning">Update</a>
                                            <form action="{{ route('enrichmentBooks.destroy', $book->id) }}" method="POST" style="display:inline;">
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
