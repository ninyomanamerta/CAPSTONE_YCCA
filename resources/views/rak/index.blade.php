@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Rak Buku</h1>

      <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
      <a href="{{ route('rak.create') }}" class="btn btn-primary">Tambah Rak</a>
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
              <h1 class="card-title px-2" style="font-size: 16px">Daftar Rak Penyimpanan</h1>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Lokasi Rak</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tgl Ditambahkan</th>
                    <th scope="col" style="display: flex; justify-content: flex-end;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                {{-- looping row --}}
                @foreach ($rak as $index => $rak)
                  <tr>
                    <th scope="row" class="col-1">{{ $index + 1 }}</th>
                    <td class="col-2">{{ $rak->lokasi }}</td>
                    <td class="col-1">{{ $rak->keterangan }}</td>
                    <td class="col-1">{{ \Carbon\Carbon::parse($rak->created_at)->format('F d, Y') }}</td>
                    <td class="col-0" style="display: flex; justify-content: flex-end;">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#rakModal" data-id="{{ $rak->id }}" class="view-rak"><span class="badge bg-success">View</span></a>

                        <a href="{{ route('rak.edit', $rak->id) }}"><span class="badge bg-warning">Update</span></a>

                        <form action="{{ route('rak.destroy', $rak->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                        </form>
                    </td>
                  </tr>
                @endforeach

                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->

        <!-- Modal -->
        <div class="modal fade" id="rakModal" tabindex="-1" aria-labelledby="rakModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rakModalLabel">Detail Rak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Lokasi Rak:</strong> <span id="modal-lokasi"></span></p>
                        <p><strong>Keterangan:</strong> <span id="modal-keterangan"></span></p>
                        <p><strong>Tanggal Dibuat:</strong> <span id="modal-tanggal"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.view-rak').on('click', function() {
                    var rakId = $(this).data('id');

                    $.ajax({
                        url: '/rak/' + rakId,
                        method: 'GET',
                        success: function(data) {
                            console.log(data);
                            $('#modal-lokasi').text(data.lokasi);
                            $('#modal-keterangan').text(data.keterangan);

                            // Format tanggal
                            const date = new Date(data.created_at);
                            const options = { year: 'numeric', month: 'long', day: 'numeric' };
                            $('#modal-tanggal').text(date.toLocaleDateString(undefined, options));
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });


        </script>


      </div>
    </section>
</main>

@endsection
