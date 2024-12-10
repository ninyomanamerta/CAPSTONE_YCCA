@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-2">Detail Data Buku Paket</h1>
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


      {{-- <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
      <a href="" class="btn btn-primary">Tambah Buku Paket</a>
      </div> --}}

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
                <h5 class="card-title2">{{ $packageBook->judul }} </h5>
                <div class="row">
                  <!-- Kolom untuk ikon -->
                  <div class="col-1 d-flex align-items-start mt-1">
                    <i class="bi bi-journal-bookmark" style="font-size: 60px; color: #798eb3;"></i>
                  </div>
                  <!-- Kolom untuk teks -->
                  <div class="col-4 mt-3 mb-2">
                    <h5 class="sub-title">Jenis : {{ $packageBook->jenis->jenis_buku }}</h5>
                    <h5 class="sub-title">Mapel : {{ $packageBook->mapel->mapel }}</h5>
                    <h5 class="sub-title">Sub I : {{ $packageBook->submapel ? $packageBook->submapel->sub_mapel : '-' }}</h5>
                </div>
                <div class="col-6 mt-3">
                    <h5 class="sub-title">Sub II : {{ $packageBook->subkelas ? $packageBook->subkelas->sub_kelas : '-' }}</h5>
                    <h5 class="sub-title">Sub III : {{ $packageBook->subklasifikasi ? $packageBook->subklasifikasi->klasifikasi : '-' }}</h5>
                    <h5 class="sub-title">Sub IV : {{ $packageBook->subklasifikasith ? $packageBook->subklasifikasith->klasifikasi4 : '-' }}</h5>
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
            <h1 class="card-title px-2" style="font-size: 16px">Daftar Detail Buku Paket</h1>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Mapel</th>
                    <th>Nomor Induk</th>
                    <th style="display: flex; justify-content: flex-end;">Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($packageBook->detailPackageBooks as $index => $detail)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $packageBook->judul }}</td>
                      <td>{{ $packageBook->mapel->mapel }}</td>
                      <td>
                        {{ $packageBook->jenis->nomor_induk_jenis }}{{ $packageBook->mapel->nomor_induk_mapel }}{{ optional($packageBook->submapel)->nomor_induk_submapel }}{{ optional($packageBook->subkelas)->nomor_induk_subkelas }}{{ optional($packageBook->subklasifikasi)->nomor_induk_klasifikasi }}{{ optional($packageBook->subklasifikasith)->nomor_induk_klasifikasi4 }}.{{ str_pad($detail->nomor_induk, 4, '0', STR_PAD_LEFT) }}
                      </td>
                      <td>
                        @if($detail->status_peminjaman === 'available')
                        <a href="#" class="badge bg-success">Available</a>
                        @elseif ($detail->status_peminjaman === 'damaged')
                            <a href="#" class="badge bg-warning">Buku Rusak</a>
                        @else
                            <a href="#" class="badge bg-secondary">No Available</a>
                        @endif
                        {{-- <form action="" method="POST" style="display:inline;">
                        </form> --}}
                      </td>
                      <td>
                        <button type="button" class="badge bg-primary" style="border: none;" data-bs-toggle="modal" data-bs-target="#updateStatusModal"
                            data-id="{{ $detail->id }}" data-status="{{ $detail->status_peminjaman }}">
                            Ubah Status
                        </button>

                         <form action="{{ route('paket.destroy', $detail->id) }}" method="POST" style="display:inline;">
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
                        <form method="POST" action="{{ route('paket.updateStatus') }}">
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
