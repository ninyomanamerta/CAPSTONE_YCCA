@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        {{-- row 1 --}}
        <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-3 col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Jumlah Buku <span>| Paket</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-journal"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $totalBukuPaket }}</h6>
                  <span class="text-success small pt-1 fw-bold">{{ $bukuPaketRusak }}</span> <span class="text-muted small pt-2 ps-1">Rusak</span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->


        <!-- Sales Card -->
        <div class="col-xxl-3 col-md-6">
          <div class="card info-card revenue-card">

            <div class="card-body">
              <h5 class="card-title">Ketersediaan Buku <span>| Paket</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-bookmark-check"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $bukuPaketTersedia }}</h6>
                  <span class="text-success small pt-1 fw-bold">{{ $bukuPaketPinjam }}</span> <span class="text-muted small pt-2 ps-1">Dipinjam</span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Sales Card -->
        <div class="col-xxl-3 col-md-6">
          <div class="card info-card customers-card">

            <div class="card-body">
              <h5 class="card-title">Jumlah Buku <span>| Pengayaan</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $totalBukuPengayaan }}</h6>
                  <span class="text-success small pt-1 fw-bold">{{ $bukuPengayaanRusak }}</span> <span class="text-muted small pt-2 ps-1">Rusak</span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Sales Card -->
        <div class="col-xxl-3 col-md-6">
          <div class="card info-card book-card">

            <div class="card-body">
              <h5 class="card-title">Ketersediaan Buku <span>| Pengayaan</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-bookmark-heart"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $bukuPengayaanTersedia }}</h6>
                  <span class="text-success small pt-1 fw-bold">{{ $bukuPengayaanPinjam }}</span> <span class="text-muted small pt-2 ps-1">Dipinjam</span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        </div>

        {{-- row 2 --}}

        <div class="row">

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Status Buku Paket <span>| Total Peminjaman : {{ $totalPeminjaman }}</span></h5>

                <!-- Doughnut Chart -->
                <canvas id="paket" style="max-height: 200px;"></canvas>
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#paket'), {
                      type: 'doughnut',
                      data: {
                        labels: [
                            'Sedang Dipinjam',
                            'Dikembalikan',
                            'Dikembalikan (Ganti Baru)'
                        ],
                        datasets: [{
                          label: 'Jumlah',
                          data: [
                            {{ $statusBorrowed }},
                            {{ $statusReturned }},
                            {{ $statusGantiBaru }}
                        ],
                          backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                          ],
                          hoverOffset: 4
                        }]
                      }
                    });
                  });
                </script>
                <!-- End Doughnut CHart -->

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Status Buku Pengayaan<span>| Total Peminjaman : {{ $totalPeminjamanPengayaan }}</span> </h5>

                <!-- Doughnut Chart -->
                <canvas id="pengayaan" style="max-height: 200px;"></canvas>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      const data = {
                        sedangDiPinjam: {{ $sedangDiPinjam }},
                        dikembalikan: {{ $dikembalikan }},
                        terlambat: {{ $terlambat }},
                      };

                      new Chart(document.querySelector('#pengayaan'), {
                        type: 'doughnut',
                        data: {
                          labels: ['Terlambat', 'Sedang Dipinjam', 'Dikembalikan'],
                          datasets: [{
                            label: 'Jumlah',
                            data: [data.terlambat, data.sedangDiPinjam, data.dikembalikan],
                            backgroundColor: [
                              'rgb(255, 99, 132)',
                              'rgb(54, 162, 235)',
                              'rgb(255, 205, 86)',
                            ],
                            hoverOffset: 4
                          }]
                        }
                      });
                    });
                  </script>

                <!-- End Doughnut CHart -->

              </div>
            </div>
          </div>

        </div>

        {{-- row 3 --}}

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Buku Pengayaan Favorit</h5>

                <!-- Bar Chart -->
                <canvas id="barChart" style="max-height: 400px;"></canvas>
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    const bookLabels = @json($mostBorrowedBooks->pluck('book_title')->toArray());
                    const bookData = @json($mostBorrowedBooks->pluck('total_peminjaman')->toArray());


                    new Chart(document.querySelector('#barChart'), {
                      type: 'bar',
                      data: {
                        labels: bookLabels,
                        datasets: [{
                          label: 'Jumlah Peminjam',
                          data: bookData,
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                          ],
                          borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                          ],
                          borderWidth: 1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  });
                </script>
                <!-- End Bar CHart -->

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Jumlah Peminjaman Buku Pengayaan</h5>

                <!-- Line Chart -->
                <canvas id="lineChart" style="max-height: 400px;"></canvas>
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    const dates = @json($dailyData->pluck('date')->toArray());
                    const totalPeminjaman = @json($dailyData->pluck('total_peminjaman')->toArray());

                    const labels = dates.map(date => {
                        const parsedDate = new Date(date);
                        const day = String(parsedDate.getDate()).padStart(2, '0');
                        const month = String(parsedDate.getMonth() + 1).padStart(2, '0');
                        const year = parsedDate.getFullYear();
                        return `${day}/${month}/${year}`; 
                    });


                    new Chart(document.querySelector('#lineChart'), {
                      type: 'line',
                      data: {
                        labels: labels,
                        datasets: [{
                          label: 'Jumlah Peminjam',
                          data: totalPeminjaman,
                          fill: false,
                          borderColor: 'rgb(75, 192, 192)',
                          tension: 0.1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  });
                </script>
                <!-- End Line CHart -->

              </div>
            </div>
          </div>

        </div>



    </section>
</main>

{{-- <div class="card">
    <div class="card-body">
      <h5 class="card-title">Pie Chart</h5>

      <!-- Pie Chart -->
      <canvas id="pieChart" style="max-height: 400px;"></canvas>
      <script>
        document.addEventListener("DOMContentLoaded", () => {
          new Chart(document.querySelector('#pieChart'), {
            type: 'pie',
            data: {
              labels: [
                'Red',
                'Blue',
                'Yellow'
              ],
              datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                  'rgb(255, 99, 132)',
                  'rgb(54, 162, 235)',
                  'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
              }]
            }
          });
        });
      </script>
      <!-- End Pie CHart -->

    </div>
  </div>
</div> --}}


@endsection
