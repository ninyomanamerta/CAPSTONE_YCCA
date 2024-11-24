@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Daftar Buku Pengayaan</h1>
        <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
            {{-- <a href="" class="btn btn-primary">Tambah Buku Paket</a> --}}
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>

    <section class="section dashboard">
        <div class="row mt-4">
            <div class="col-12 px-3">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Detail Buku Pengayaan</h1>

                        <form action="{{ route('enrichmentBooks.updateDamagedBooks') }}" method="POST">
                            @csrf
                            @method('PATCH')

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>No Induk</th>
                                    <th>Th Terbit</th>
                                    <th>Pengarang</th>
                                    <th>Rak</th>
                                    <th>Status</th>
                                    <th>Tandai Rusak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $globalIndex = 1; @endphp
                                @foreach($enrichmentBooks as $enrichmentBook)
                                    @foreach($enrichmentBook->detailEnrichmentBooks as $detail)
                                        <tr>
                                            <td>{{ $globalIndex++ }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($enrichmentBook->judul, 20, '...') }}</td>
                                            <td>{{ str_pad($detail->no_induk, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $enrichmentBook->tahun }}</td>
                                            <td>{{ $enrichmentBook->pengarang }}</td>
                                            <td>{{ $enrichmentBook->bookcase->lokasi ?? '-' }}</td>
                                            <td>
                                                @if($detail->status_peminjaman === 'available')
                                                    <span class="badge bg-success">Available</span>
                                                @else
                                                    <span class="badge bg-secondary">No Available</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="checkbox" name="damaged_books[]" value="{{ $detail->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-danger float-end mt-2">Simpan Perubahan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
