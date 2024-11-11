@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Klasifikai Buku</h1>

      <nav>
        <ol class="breadcrumb text-bold mt-1">
            <li class="breadcrumb-item active"><a href="" style="color: #1c1b1a; font-weight: bold; font-size:15px;"><b>Jenis</b></a></li>
            <li class="breadcrumb-item active"><a href="">Mapel</a></li>
            <li class="breadcrumb-item active"><a href="">Sub Mapel</a></li>
            <li class="breadcrumb-item active"><a href="">Sub Kelas</a></li>
        </ol>
      </nav>
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
                      <td class="col-1">{{ $item->created_at->format('d-m-Y') }}</td>
                      <td class="col-0" style="display: flex; justify-content: flex-end;">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#jenisModal" data-id="{{ $item->id }}" class="view-jenis"><span class="badge bg-success">View</span></a>
                          <a href="{{ route('jenis.edit', $item->id) }}"><span class="badge bg-warning">Update</span></a>                   
                          <form action="{{ route('jenis.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="badge bg-danger" style="border: none;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
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
              <p><strong>Jenis Buku:</strong> <span id="modal-jenis_buku"></span></p>
              <p><strong>Nomor Induk:</strong> <span id="modal-nomor_induk_jenis"></span></p>
              <p><strong>Tanggal Ditambahkan:</strong> <span id="modal-tanggal"></span></p>
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
        // Handle View button click
        $('.view-jenis').on('click', function() {
            var jenisId = $(this).data('id');

            // Fetch the BookType data using AJAX
            $.ajax({
                url: '/klasifikasi/jenis/' + jenisId,  // Assuming the route is correct
                method: 'GET',
                success: function(data) {
                    // Populate modal with the data from AJAX response
                    $('#modal-jenis_buku').text(data.jenis_buku);
                    $('#modal-nomor_induk_jenis').text(data.nomor_induk_jenis);

                    // Format the date
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

    </section>
</main>

@endsection