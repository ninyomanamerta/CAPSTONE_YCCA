<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
<style>
  /* Style untuk item dropdown */
.sidebar-nav .sidebar-submenu {
    padding-left: 15px;
}

.sidebar-nav .sidebar-submenu li {
    padding: 8px 15px;
    border-radius: 5px;
    transition: background 0.3s;
}

.sidebar-nav .sidebar-submenu li a {
    color: #007bff;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
}

.sidebar-nav .sidebar-submenu li:hover {
    background-color: #f0f4ff;
}

/* Style untuk icon di dropdown item */
.sidebar-nav .nav-link i {
    margin-right: 8px;
}

</style>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item" style="padding-top: 10px">
            <a class="nav-link collapsed " href="{{ route('home') }}">
                <i class="bi bi-house-door"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed " href="{{ route('student.index') }}">
                <i class="bi bi-person"></i>
                <span>Siswa</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-toggle="collapse" href="#klasifikasiSubmenu" role="button" aria-expanded="false" aria-controls="klasifikasiSubmenu">
              <i class="bi bi-tags"></i>
              <span>Klasifikasi</span>
              <i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="klasifikasiSubmenu" class="collapse sidebar-submenu">
              <li><a class="nav-link" href="{{ route('jenis.index') }}">Jenis</a></li>
              <li><a class="nav-link" href="{{ route('course.index') }}">Mata Pelajaran</a></li>
              <li><a class="nav-link" href="{{ route('subCourse.index') }}">Sub Mata Pelajaran</a></li>
              <li><a class="nav-link" href="{{ route('class.index') }}">Sub Kelas</a></li>
              <!-- Tambahkan klasifikasi lain jika diperlukan -->
          </ul>
      </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-search"></i>
                <span>Cari</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('rak.index') }}">
                <i class="bi bi-archive"></i>
                <span>Rak</span>
            </a>


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#buku" role="button" aria-expanded="false" aria-controls="buku">
                <i class="bi bi-book"></i>
                <span>Manajemen Buku</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="buku" class="collapse sidebar-submenu">
                <li><a class="nav-link" href="{{ route('paket.index') }}">Buku Paket</a></li>
                <li><a class="nav-link" href="{{ route('enrichmentBooks.index') }}"> Buku Pengayaan</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#peminjaman" role="button" aria-expanded="false" aria-controls="peminjaman">
                <i class="bi bi-calendar-check"></i>
                <span>Peminjaman Buku</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="peminjaman" class="collapse sidebar-submenu">
                <li><a class="nav-link" href="{{ route('pinjamPaket.index') }}">Paket</a></li>
                <li><a class="nav-link" href="{{ route('peminjamanbukupengayaan.index') }}">Pengayaan</a></li>
            </ul>
        </li>
        <!-- End Register Page Nav -->




        <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>End Profile Page Nav -->

        <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li>End Login Page Nav

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.php">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li>End Register Page Nav -->






    </ul>

</aside><!-- End Sidebar-->
