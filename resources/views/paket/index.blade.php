@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Buku Paket</h1>

        <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
            <a href="{{ route('paket.create') }}" class="btn btn-primary mr-2">Tambah Buku Paket</a>
            <span><a href="{{ route('paket.showAll') }}" class="btn btn-success mr-2">Semua Buku Paket</a></span>
            <span><a href="{{ route('paket.damaged') }}" class="btn btn-danger">Tandai Buku Rusak</a></span>
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
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Buku Paket</h1>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Masuk</th>
                                    <th>Judul</th>
                                    <th>Thn Terbit</th>
                                    <th>Penerbit</th>
                                    <th>Eks</th>
                                    <th>Sumber</th>
                                    <th style="display: flex; justify-content: flex-end;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packageBook as $index => $packageBook)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($packageBook->tgl_masuk)->format('d M Y') }}</td>
                                        <td>{{ $packageBook->judul }}</td>
                                        <td>{{ $packageBook->tahun_terbit }}</td>
                                        <td>{{ $packageBook->penerbit }}</td>
                                        <td>{{ $packageBook->detail_package_books_count }}</td>
                                        <td>{{ $packageBook->sumber ? $packageBook->sumber : '-' }}</td>
                                        <td>
                                            <a href="{{ route('paket.detail', $packageBook->id) }}" class="badge bg-success">Detail</a>
                                            <a href="{{ route('paket.edit', $packageBook->id) }}" class="badge bg-warning">Update</a>

                                            <form action="{{ route('paket.destroyAll', $packageBook->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge bg-danger hover-effect" style="border: none; " onclick="return confirm('Yakin ingin menghapus semua buku paket?');">Delete</button>
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
