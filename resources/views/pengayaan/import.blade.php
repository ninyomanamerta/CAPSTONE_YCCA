@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-2">Import Data Buku Pengayaan</h1>
      <nav class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:history.back()">
                    <i class="bi bi-arrow-left-short" style="font-size: 20px"></i>
                    <span style="font-size: 20px">Kembali</span>
                </a>
            </li>
        </ol>
    </nav>
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif


      <div class="card mt-2">
        <div class="card-body">
            <h4 class="card-title ml-4 mb-6">Formulir Tambah Buku Pengayaan</h4>

          <!-- Horizontal Form -->
          <form action="{{ route('enrichmentBooks.proses') }}" method="POST" enctype="multipart/form-data" class="px-3">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-12">Masukan Data Buku Pengayaan</label>
            </div>

            <div class="col-sm-12">
                <input type="file" class="form-control" id="books" name="books" required value="{{ old('books') }}">
            </div>


            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('enrichmentBooks.index') }}" class="mt-2 btn btn-warning mb-2">Batal</a>
            </div>
          </form><!-- End Horizontal Form -->

        </div>
      </div>


    </div>
</section>
</main>


@endsection
