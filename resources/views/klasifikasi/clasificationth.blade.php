@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Sub Klasifikasi IV</h1>

      <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
      <a href="{{ route('klasifikasiTh.create') }}" class="btn btn-primary">Tambah Sub Klasifikasi IV</a>
      </div>
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
              <h1 class="card-title px-2" style="font-size: 16px">Daftar Sub Klasifikasi IV</h1>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Sub IV</th>
                    <th scope="col">Sub Klasifikasi IV</th>
                    <th scope="col">Nomor Induk</th>
                    <th scope="col">Tgl Ditambahkan</th>
                    <th scope="col" style="display: flex; justify-content: flex-end;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                {{-- looping row --}}
                @foreach ($class as $index => $class)
                  <tr>
                    <th scope="row" class="col-1">{{ $index + 1 }}</th>
                    <td class="col-1">{{ $class->id }}</td>
                    <td class="col-1">{{ $class->klasifikasi4 }}</td>
                    <td class="col-1">{{ $class->nomor_induk_klasifikasi4 }}</td>
                    <td class="col-1">{{ \Carbon\Carbon::parse($class->created_at)->format('F d, Y') }}</td>
                    <td class="col-0" style="display: flex; justify-content: flex-end;">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#classModal" data-id="{{ $class->id }}" class="view-class"><span class="badge bg-success">View</span></a>

                        <a href="{{ route('klasifikasiTh.edit', $class->id) }}"><span class="badge bg-warning">Update</span></a>

                        <form action="{{ route('klasifikasiTh.destroy', $class->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Semua data terkait subkelas akan terhapus. Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                        </form>
                    </td>
                  </tr>
                @endforeach
                  {{-- <tr>
                    <th scope="row" class="col-1">2</th>
                    <td class="col-1">8</td>
                    <td class="col-1">2</td>
                    <td class="col-1">12-10-2024</td>
                    <td class="col-0" style="display: flex; justify-content: flex-end;">
                        <a href=""><span class="badge bg-success">View</span></a>
                        <a href=""><span class="badge bg-warning">Update</span></a>
                        <a href=""><span class="badge bg-danger">Delete</span></a>
                    </td>
                  </tr> --}}

                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->

        <!-- Modal -->
        <div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="classModalLabel">Detail Sub Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>ID Sub IV:</strong> <span id="modal-id"></span></p>
                        <p><strong>Sub Klasifikasi IV:</strong> <span id="modal-class"></span></p>
                        <p><strong>No Induk:</strong> <span id="modal-noinduk"></span></p>
                        <p><strong>Tanggal Dibuat:</strong> <span id="modal-tanggal"></span></p>
                        <p><strong>Tanggal Update:</strong> <span id="modal-tanggal-update"></span></p>
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
            $('.view-class').on('click', function() {

                $('#modal-id').text('Loading...');
                $('#modal-class').text('Loading...');
                $('#modal-noinduk').text('Loading...');
                $('#modal-tanggal').text('Loading...');
                $('#modal-tanggal-update').text('Loading...');

                var classId = $(this).data('id');

                $.ajax({
                    url: '/klasifikasi/subIV/' + classId,
                    method: 'GET',
                    success: function(data) {
                        console.log(data);
                        $('#modal-id').text(data.id);
                        $('#modal-class').text(data.klasifikasi4);
                        $('#modal-noinduk').text(data.nomor_induk_klasifikasi4);

                        // Format tanggal
                        const createdDate = new Date(data.created_at);
                        const options = { year: 'numeric', month: 'long', day: 'numeric' };
                        $('#modal-tanggal').text(createdDate.toLocaleDateString(undefined, options));

                        const updatedDate = new Date(data.updated_at);
                        $('#modal-tanggal-update').text(updatedDate.toLocaleDateString(undefined, options));

                        // Tampilkan modal
                        $('#classModal').modal('show');
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan saat memuat data.');
                    }
                });
            });
        });
        </script>


      </div>
    </section>

</main>

@endsection
