@extends('layouts.master')
@section('content')
<style>
.modal-body p {
  margin-bottom: 8px;
  font-size: 14px;
}
</style>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Klasifikasi Jenis Buku</h1>

      <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
      <a href="{{ route('jenis.create') }}" class="btn btn-primary">Tambah Jenis Buku</a>
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
              <h1 class="card-title px-2" style="font-size: 16px">Daftar Jenis Buku</h1>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis Buku</th>
                    <th scope="col">Nomor Induk</th>
                    <th scope="col">Tgl Ditambahkan</th>
                    <th scope="col" style="display: flex; justify-content: flex-end;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                {{-- looping row --}}
                  @foreach($jenis as $key => $item)
                    <tr>
                      <th scope="row" class="col-1">{{ $key + 1 }}</th>
                      <td class="col-2">{{ $item->jenis_buku }}</td>
                      <td class="col-1">{{ $item->nomor_induk_jenis }}</td>
                      <td class="col-1">{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
                      <td class="col-0" style="display: flex; justify-content: flex-end;">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#jenisModal" data-id="{{ $item->id }}" class="view-jenis"><span class="badge bg-success">View</span></a>
                          <a href="{{ route('jenis.edit', $item->id) }}"><span class="badge bg-warning">Update</span></a>
                          <form action="{{ route('jenis.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Semua data terkait jenis buku akan terhapus. Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                        </form>
                    </td>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->


      </div>
         <!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="jenisModal" tabindex="-1" aria-labelledby="jenisModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="jenisModalLabel">Detail Jenis Buku</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><strong>Jenis Buku:</strong> {{ $item->jenis_buku }}</span></p>
            <p><strong>Nomor Induk:</strong> {{ $item->nomor_induk_jenis }}</span></p>
            <p><strong>Tanggal Ditambahkan:</strong> {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</span></p>
            <p><strong>Tanggal Perubahan:</strong> {{ \Carbon\Carbon::parse($item->updated_at)->format('F d, Y') }}</span></p>
        </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
      </div>
  </div>
</div>

    </section>
</main>

@endsection
