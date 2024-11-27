@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
      <h1 class="mb-2">Tambah Data Rak</h1>
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


      <div class="card">
        <div class="card-body">
            <h4 class="card-title ml-4 mb-6">Formulir Tambah Data Rak</h4>

          <!-- Horizontal Form -->
          <form action="{{ route('rak.store') }}" method="POST" class="px-3">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Lokasi rak</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukan lokasi rak" required value="{{ old('lokasi') }}" >
              </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Jelaskan lokasi rak" rows="3" required maxlength="65" oninput="updateCharacterCount()" maxlength="65">{{ old('keterangan') }}</textarea>
                    <div id="characterCount" class="mt-1" style="display: flex; justify-content: flex-end; font-size: 14px; color: gray;">0 / 65</div>
                </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('rak.index') }}" class="mt-2 btn btn-warning mb-2">Batal</a>
            </div>
          </form><!-- End Horizontal Form -->

        </div>
      </div>

      <script>
        function updateCharacterCount() {
            const textarea = document.getElementById('keterangan');
            const characterCount = document.getElementById('characterCount');
            const currentLength = textarea.value.length;

            characterCount.textContent = `${currentLength} / 65 `;

            if (currentLength >= 65) {
                textarea.value = textarea.value.substring(0, 65);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCharacterCount();
        });
    </script>

    </div>
</section>
</main>


@endsection
