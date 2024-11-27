@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Peminjaman Buku Pengayaan</h1>

        <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
            <a href="{{ route('peminjamanbukupengayaan.create') }}" class="btn btn-primary">Tambah Buku Pinjam</a>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert" style="padding-top:10px">
                {{ Session::get('success') }}
            </div>
        @endif
    </div><!-- End Page Title -->

    <section class="section dashboard mt-4">
        <div class="row">
            <div class="col-12 px-3">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Peminjaman Buku Pengayaan</h1>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Buku yang Dipinjam</th>
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Tanggal Pengembalian</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="display: flex; justify-content: flex-end;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman_pengayaan as $index => $peminjaman)
                                    <tr>
                                        <th scope="row" class="col-1">{{ $index + 1 }}</th>
                                        <td class="col-2">{{ $peminjaman->student->nama_siswa }}</td>
                                        <td class="col-3">{{ $peminjaman->book->judul }}</td>
                                        <td class="col-2">{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('F d, Y') }}</td>
                                        <td class="col-2">{{ \Carbon\Carbon::parse($peminjaman->tgl_pengembalian)->format('F d, Y') }}</td>
                  

                                          {{-- Fetch status from the related detail_buku --}}
                                          <td>
                                            @if($peminjaman->status === 'dikembalikan')
                                            <span class="badge bg-warning">Buku telah Dikembalikan</span>
                                        @elseif($peminjaman->status === 'dipinjam')
                                            <span class="badge bg-primary">Di Pinjam</span>
                                        @elseif($peminjaman->status === 'telat')
                                            <span class="badge bg-danger">Telat Pengembalian</span>
                                        @endif                                
                                          </td>
                                          <td style="display: flex; gap: 10px; justify-content: flex-end;">
                                            {{-- Lihat Detail --}}
                                           <a href="#" class="badge bg-success" style="border:none" data-bs-toggle="modal" data-bs-target="#detailModal{{ $peminjaman->id }}">
                                              Lihat Detail
                                          </a>
                                        
                                            {{-- Verifikasi Pengembalian --}}
                                            <button type="button" class="badge bg-warning"  style="border:none" data-bs-toggle="modal" data-bs-target="#verifikasiModal{{ $peminjaman->id }}">
                                                Verifikasi
                                            </button>
                                        
                                            {{-- Delete --}}
                                            <button type="button" class="badge bg-danger" style="border:none" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $peminjaman->id }}">
                                                Delete
                                            </button>
                                          </td> 

                                                {{-- Modal Konfirmasi Pengembalian --}}
                                                <div class="modal fade" id="verifikasiModal{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="verifikasiModalLabel{{ $peminjaman->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="verifikasiModalLabel{{ $peminjaman->id }}">Verifikasi Pengembalian Buku</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin buku telah dikembalikan oleh siswa <strong>{{ $peminjaman->student->nama_siswa }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <form action="{{ route('peminjamanbukupengayaan.update', $peminjaman->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="status" value="dikembalikan">
                                                                    <button type="submit" class="btn btn-primary">Ya, Kembalikan</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Modal Detail Buku -->                                              
                                                <div class="modal fade" id="detailModal{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="detailModalLabel">Detail Peminjaman Buku</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Nama Siswa:</strong> {{ $peminjaman->student->nama_siswa }}</p>
                                                                <p><strong>Buku yang Dipinjam:</strong> {{ $peminjaman->book->judul }}</p>
                                                                <p><strong>Dikasih oleh:</strong> {{ $peminjaman->peminjam }}</p>
                                                                <p><strong>Nomor Induk Buku:</strong> {{ str_pad($peminjaman->id_detail_buku, 4, '0', STR_PAD_LEFT) }}</p>
                                                                <p><strong>Tanggal Peminjaman:</strong> {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('F d, Y') }}</p>
                                                                <p><strong>Tanggal Pengembalian:</strong> {{ \Carbon\Carbon::parse($peminjaman->tgl_pengembalian)->format('F d, Y') }}</p>
                                                                <p><strong>Status:</strong> 
                                                                    @if($peminjaman->status === 'dikembalikan')
                                                                        <span class="badge bg-warning">Buku telah Dikembalikan</span>
                                                                    @elseif($peminjaman->status === 'dipinjam')
                                                                        <span class="badge bg-primary">Di Pinjam</span>
                                                                    @elseif($peminjaman->status === 'telat')
                                                                        <span class="badge bg-danger">Telat Pengembalian</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <!-- Modal Konfirmasi Delete -->
                                                <div class="modal fade" id="deleteModal{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $peminjaman->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel{{ $peminjaman->id }}">Konfirmasi Penghapusan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data peminjaman ini?
                                                                <p></p>
                                                                <p><strong>Nama Siswa:</strong> {{ $peminjaman->student->nama_siswa }}</p>
                                                                <p><strong>Buku:</strong> {{ $peminjaman->book->judul }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <form action="{{ route('peminjamanbukupengayaan.destroy', $peminjaman->id) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                   
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
