@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Detail Data Buku Pengayaan</h1>

        <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
            <a href="{{ route('enrichmentBooks.create') }}" class="btn btn-primary">Tambah Buku Pengayaan</a>
        </div>

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
                <h5 class="card-title2">Penelitian Terhadap Matahari Bumi Bulan Manusia</h5>
                <div class="row">
                  <!-- Kolom untuk ikon -->
                  <div class="col-1 d-flex align-items-start mt-3">
                    <i class="bi bi-journal-bookmark" style="font-size: 60px; color: #798eb3;"></i>
                  </div>
                  <!-- Kolom untuk teks -->
                  <div class="col-4 mt-3 mb-2">
                    <h5 class="sub-title">Tahun Terbit : 2015</h5>
                    <h5 class="sub-title">Pengarang : Author</h5>
                    <h5 class="sub-title">Penerbit : Gramedia</h5>
                    <h5 class="sub-title">Eksemplar : 10</h5>

                    {{-- <p class="par">Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p> --}}
                  </div>
                  <div class="col-6 mt-3">
                    <h5 class="sub-title">Dipinjam : 5</h5>
                    <h5 class="sub-title">Tanggal Masuk : 11 November 2024</h5>
                    <h5 class="sub-title">Rak : 1A <span>| Ada disebelah kiri kanan kulihat saja</span></h5>
                  </div>
                </div>
            </div>

        </div><!-- End Default Card -->
    </section>

</main>

@endsection
