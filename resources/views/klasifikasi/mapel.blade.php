@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Klasifikasi Buku</h1>

      <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
      <a href="{{ route('course.create') }}" class="btn btn-primary">Tambah Mapel Buku</a>
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
              <h1 class="card-title px-2" style="font-size: 16px">Daftar Mapel Buku</h1>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Mapel Buku</th>
                    <th scope="col">Nomor Induk</th>
                    <th scope="col">Tgl Ditambahkan</th>
                    <th scope="col" style="display: flex; justify-content: flex-end;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                {{-- looping row --}}
                @foreach ($course as $index => $course)
                  <tr>
                    <th scope="row" class="col-1">{{ $index + 1 }}</th>
                    <td class="col-1">{{ $course->mapel }}</td>
                    <td class="col-1">{{ $course->nomor_induk_mapel }}</td>
                    <td class="col-1">{{ \Carbon\Carbon::parse($course->created_at)->format('F d, Y') }}</td>
                    <td class="col-0" style="display: flex; justify-content: flex-end;">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#courseModal" data-id="{{ $course->id }}" class="view-course"><span class="badge bg-success">View</span></a>

                        <a href="{{ route('course.edit', $course->id) }}"><span class="badge bg-warning">Update</span></a>

                        <form action="{{ route('course.destroy', $course->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                        </form>
                    </td>
                  </tr>
                @endforeach
                  {{-- <tr>
                    <th scope="row" class="col-1">2</th>
                    <td class="col-1">Matematika</td>
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
         <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="courseModalLabel">Detail Mapel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Mapel:</strong> <span id="modal-course"></span></p>
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
        $('.view-course').on('click', function() {
            $('#modal-course').text('Loading...');
            $('#modal-noinduk').text('Loading...');
            $('#modal-tanggal').text('Loading...');
            $('#modal-tanggal-update').text('Loading...');

            var courseId = $(this).data('id');

            $.ajax({
                url: '/klasifikasi/mapel/' + courseId,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#modal-course').text(data.mapel);
                    $('#modal-noinduk').text(data.nomor_induk_mapel);

                    // Format tanggal
                    const createdDate = new Date(data.created_at);
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    $('#modal-tanggal').text(createdDate.toLocaleDateString(undefined, options));

                    const updatedDate = new Date(data.updated_at);
                    $('#modal-tanggal-update').text(updatedDate.toLocaleDateString(undefined, options));

                    // Tampilkan modal
                    $('#courseModal').modal('show');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat memuat data.');
                }
            });
        });
    });
</script>



        </script>

      </div>
      @push('scripts')
    </section>
</main>

@endsection
