<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>EduLib</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/Photo/edulib.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Favicons -->
        <link href="{{ asset('assets/Photo/edulib.png') }}" rel="icon">
        <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('assets/css/styles2.css') }}" rel="stylesheet">
    </head>
    <body>

        <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="assets/mp4/bg2.mp4" type="video/mp4" /></video>
        <!-- Masthead-->
        <div class="masthead">
            <div class="masthead-content text-white">
                <div class="container-fluid px-4 px-lg-0">

                    {{-- <h1 class="fst-italic lh-1 mb-4">Selamat Datang Di EduLib</h1> --}}
                    <p class="mb-5">Isi data dibawah dengan lengkap untuk daftarkan akun Anda!</p>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" id="contactForm">
                            @csrf

                            <!-- Name input -->
                            <div class="row input-group-newsletter mb-3">
                                <div class="col">
                                    <input
                                        id="name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Masukan Nama Anda..."
                                        required
                                        autofocus
                                    />
                                    @error('name')
                                    <div class="invalid-feedback mt-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- NIP input -->
                            <div class="row input-group-newsletter mb-3">
                                <div class="col">
                                    <input
                                        id="nip"
                                        type="number"
                                        class="form-control @error('nip') is-invalid @enderror"
                                        name="nip"
                                        value="{{ old('nip') }}"
                                        placeholder="Masukan NIP Anda..."
                                    />
                                    @error('nip')
                                    <div class="invalid-feedback mt-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Jabatan input -->
                            <div class="row input-group-newsletter mb-3">
                                <div class="col">
                                    <input
                                        id="jabatan"
                                        type="text"
                                        class="form-control @error('jabatan') is-invalid @enderror"
                                        name="jabatan"
                                        value="{{ old('jabatan') }}"
                                        placeholder="Masukan Jabatan Anda..."
                                        required
                                    />
                                    @error('jabatan')
                                    <div class="invalid-feedback mt-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email address input -->
                            <div class="row input-group-newsletter mb-3">
                                <div class="col">
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Masukan Alamat Email..."
                                        required
                                    />
                                    @error('email')
                                    <div class="invalid-feedback mt-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password input -->
                            <div class="row input-group-newsletter mb-3">
                                <div class="col">
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        placeholder="Masukan Password..."
                                        required
                                    />
                                    @error('password')
                                    <div class="invalid-feedback mt-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm Password input -->
                            <div class="row input-group-newsletter mb-3">
                                <div class="col">
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        placeholder="Konfirmasi Password..."
                                        required
                                    />
                                </div>
                            </div>

                                <!-- Submit button -->
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <button
                                            class="btn btn-primary"
                                            id="submitButton"
                                            type="submit"
                                        >
                                            Register
                                        </button>
                                    </div>
                                    <div class="col">
                                        <p class="mb-0" style="font-size: 16px">
                                            Sudah punya akun?
                                            <a href="{{ route('login') }}" style="color: #ffff">Login disini</a>
                                        </p>
                                    </div>
                                </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- Bootstrap core JS-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nip" class="col-md-4 col-form-label text-md-end">{{ __('Nip') }}</label>

                            <div class="col-md-6">
                                <input id="nip" type="number" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" required autocomplete="nip" autofocus>

                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jabatan" class="col-md-4 col-form-label text-md-end">{{ __('Jabatan') }}</label>

                            <div class="col-md-6">
                                <input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ old('jabatan') }}" required autocomplete="jabatan" autofocus>

                                @error('jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
