@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-4">Data Peminjaman Buku Paket</h1>
    </div>

    <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
        <a href="{{ route('pinjamPaket.create') }}" class="btn btn-primary mb-3">Tambah Peminjaman Buku Paket</a>
    </div>

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert" style="padding-top:10px">
            {{ Session::get('success') }}
        </div>
    @endif

    <section class="section dashboard">
        <div class="row">
            <!-- Search input -->
            {{-- <div class="col-12 mb-3 mt-2">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari nama siswa..." onkeyup="searchFunction()">
            </div> --}}

            <div class="col-12 px-3">
                <div class="card recent-sales overflow-auto">

                  <div class="card-body">
                    <h1 class="card-title px-2" style="font-size: 16px">Daftar Nama Siswa</h1>

                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">NIS</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Kelas</th>
                          <th scope="col" style="display: flex; justify-content: flex-end;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      {{-- looping row --}}
                      @foreach ($siswaPeminjam as $index => $student)
                          <tr>
                              <th scope="row" class="col-1">{{ $index + 1 }}</th>
                              <td class="col-2">{{ $student->nis }}</td>
                              <td class="col-3">{{ $student->nama_siswa }}</td>
                              <td class="col-1">{{ $student->kelas }}</td>
                              <td class="col-0" style="display: flex; justify-content: flex-end;">
                                  <a href="{{ route('pinjamPaket.detail', $student->id) }}"><span class="badge bg-success">Lihat Detail</span></a>


                              </td>
                            </tr>
                      @endforeach
                      </tbody>
                    </table>

                  </div>

                </div>
              </div><!-- End Recent Sales -->



            {{-- Example data --}}
            {{-- <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Flex container for student info -->
                            <div class="d-flex w-100 justify-content-between">
                                <div class="flex-fill">
                                    <p class="mb-0"><strong>Farhan Yusuf</strong></p>
                                </div>
                                <div class="flex-fill text-center">
                                    <p class="mb-0">NIS: 123456789</p>
                                </div>
                                <div class="flex-fill text-end">
                                    <p class="mb-0">Kelas: 12 IPA 3</p>
                                </div>
                            </div>
                            <!-- Action buttons with margin-left added to create space between Kelas and buttons -->
                            <div class="ms-3">
                                <a href="#" class="btn btn-info btn-sm me-2">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Flex container for student info -->
                            <div class="d-flex w-100 justify-content-between">
                                <div class="flex-fill">
                                    <p class="mb-0"><strong>Ahmad Zaky</strong></p>
                                </div>
                                <div class="flex-fill text-center">
                                    <p class="mb-0">NIS: 123456789</p>
                                </div>
                                <div class="flex-fill text-end">
                                    <p class="mb-0">Kelas: 12 IPA 3</p>
                                </div>
                            </div>
                            <!-- Action buttons with margin-left added to create space between Kelas and buttons -->
                            <div class="ms-3">
                                <a href="#" class="btn btn-info btn-sm me-2">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Flex container for student info -->
                            <div class="d-flex w-100 justify-content-between">
                                <div class="flex-fill">
                                    <p class="mb-0"><strong>Ayu Lestari</strong></p>
                                </div>
                                <div class="flex-fill text-center">
                                    <p class="mb-0">NIS: 123456789</p>
                                </div>
                                <div class="flex-fill text-end">
                                    <p class="mb-0">Kelas: 12 IPA 3</p>
                                </div>
                            </div>
                            <!-- Action buttons with margin-left added to create space between Kelas and buttons -->
                            <div class="ms-3">
                                <a href="#" class="btn btn-info btn-sm me-2">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </section>
</main>

<script>
    function searchFunction() {
        var input, filter, cards, card, p, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        cards = document.querySelectorAll(".card-body");  // Select all card bodies
        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            p = card.getElementsByTagName("p");
            txtValue = "";
            for (var j = 0; j < p.length; j++) {
                txtValue += p[j].textContent || p[j].innerText;  // Get all text from the p tags
            }
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                card.closest('.col-12').style.display = "";  // Show matching card
            } else {
                card.closest('.col-12').style.display = "none";  // Hide non-matching card
            }
        }
    }
</script>

@endsection
