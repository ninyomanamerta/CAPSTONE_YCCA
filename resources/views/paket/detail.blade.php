@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Detail Data Buku Paket</h1>

      <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
      <a href="" class="btn btn-primary">Tambah Buku Paket</a>
      </div>

      @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
      @endif
    </div>

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
                    <th>Sub Mapel</th>
                    <th>Kelas</th>
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
                      <td>{{ $packageBook->submapel->sub_mapel }}</td>
                      <td>Kelas {{ $packageBook->subkelas->sub_kelas }}</td>
                      <td>
                        {{ $packageBook->jenis->nomor_induk_jenis }}{{ $packageBook->mapel->nomor_induk_mapel }}{{ $packageBook->submapel->nomor_induk_submapel }}{{ $packageBook->subkelas->nomor_induk_subkelas }}.{{ str_pad($detail->nomor_induk, 4, '0', STR_PAD_LEFT) }}
                      </td>
                      <td>
                        @if($detail->status_peminjaman === 'available')
                        <a href="#" class="badge bg-success">Available</a>
                        @else
                            <a href="#" class="badge bg-secondary">No Available</a>
                        @endif
                        {{-- <form action="" method="POST" style="display:inline;">
                        </form> --}}
                      </td>
                      <td>
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

            </div>
          </div>
        </div>
      </div>
    </section>
</main>

@endsection
