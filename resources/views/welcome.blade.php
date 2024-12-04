{{-- @extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <img src="{{ asset('assets/Photo/edulib.png') }}" class="mx-auto" alt=""
                style="width: 180px; height: auto; padding-bottom: 20px; padding-top: 60px;">
            <h3 style="text-align: center; color: #012970; padding-bottom : 20px">Selamat Datang EduLib!</h3>
        </div>
</main><!-- End #main -->
@endsection --}}

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
                    <img src="{{ asset('assets/Photo/edulibputih.png') }}" class="mx-auto mb-2" alt="" width="100" height="100">
                    <span style="font-size: 30px"> X </span>
                    <span><img src="{{ asset('assets/Photo/smp2baleendah.png') }}" class="mx-auto mb-2" alt="" width="100" height="100"></span>
                    <h1 class="fst-italic lh-1 mb-4">Selamat Datang Di EduLib</h1>
                    <p class="mb-5">Buat manajemen perpustakaan Anda menjadi lebih mudah. Login Atau Register untuk menggunakan EduLib!</p>

                    <div class="row input-group-newsletter">
                        <div class="col-auto">
                            <button
                                class="btn btn-primary mr-3"
                                id="submitButton"
                                type="submit"
                                style="margin-right: 2cm"
                                onclick="window.location.href='{{ route('login') }}'"
                            >
                                Login
                            </button>
                            <button
                                class="btn btn-primary"
                                id="submitButton"
                                type="submit"
                                onclick="window.location.href='{{ route('register') }}'"
                            >
                                Register
                            </button>
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
