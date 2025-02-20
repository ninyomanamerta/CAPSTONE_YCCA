@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-2">Daftar Akun</h1>
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

        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        <div class="card mt-3 shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4">Formulir Pendaftaran Akun</h4>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukan Nama Anda..." required autofocus value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" placeholder="Masukan NIP Anda..." value="{{ old('nip') }}" >
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" placeholder="Masukan Jabatan Anda..." required value="{{ old('jabatan') }}">
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukan Alamat Email..." required value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukan Password..." required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Konfirmasi Password..." required>
                        </div>
                    </div>

                    <div class="text-center d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary me-2">Daftar</button>
                        <a href="{{ route('login') }}" class="btn btn-warning">Batal</a>
                    </div>
                    
                </form><!-- End Horizontal Form -->

            </div>
        </div>

    </div>
</main>

@endsection
