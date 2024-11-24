@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Daftar Buku Paket</h1>

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
                        <h1 class="card-title px-2" style="font-size: 16px">Daftar Keseluruhan Buku Paket</h1>


                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Masuk</th>
                                        <th>Judul</th>
                                        <th>Mapel</th>
                                        <th>Sub Mapel</th>
                                        <th>Kelas</th>
                                        <th>Nomor Induk</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php $globalIndex = 1; @endphp
                                    @foreach($packageBook as $package)
                                        @foreach($package->detailPackageBooks as $index => $detail)
                                        <tr>
                                            <td>{{ $globalIndex++ }}</td>
                                            <td>{{ \Carbon\Carbon::parse($package->tgl_masuk)->format('d M Y') }}</td>
                                            <td>{{ $package->judul }}</td>
                                            <td>{{ $package->mapel->mapel }}</td>
                                            <td>{{ $package->submapel->sub_mapel }}</td>
                                            <td>Kelas {{ $package->subkelas->sub_kelas }}</td>
                                            <td>
                                                {{ $package->jenis->nomor_induk_jenis }}{{ $package->mapel->nomor_induk_mapel }}{{ $package->submapel->nomor_induk_submapel }}{{ $package->subkelas->nomor_induk_subkelas }}.{{ str_pad($detail->nomor_induk, 4, '0', STR_PAD_LEFT) }}
                                            </td>
                                            <td>
                                                @if($detail->status_peminjaman === 'available')
                                                    <a href="#" class="badge bg-success">Available</a>
                                                @elseif ($detail->status_peminjaman === 'damaged')
                                                    <a href="#" class="badge bg-danger">Buku Rusak</a>
                                                @else
                                                    <a href="#" class="badge bg-secondary">No Available</a>
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
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
