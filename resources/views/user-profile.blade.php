@extends('layouts.master')

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-4">
        <h1>Edit Profile</h1>
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
    </div>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card w-100 w-md-75 w-lg-50">
            <div class="card-header text-center bg-primary text-white">
                <h3>Form Edit Profil</h3>
            </div>

            <div class="card-body">
                <!-- Form Update Profil -->
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                            value="{{ old('nip', $user->nip) }}"/>
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror"
                            value="{{ old('jabatan', $user->jabatan) }}"/>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="current_password" class="form-label">Password Lama</label>
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror"
                            value="{{ old('current_password') }}"/>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror"
                            value="{{ old('new_password') }}"/>
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-control"
                            value="{{ old('new_password_confirmation') }}"/>
                    </div>

                    <!-- Tombol dalam satu baris dengan jarak rapat -->
                    <div class="d-flex justify-content-end mb-3">
                        <button type="submit" class="btn btn-primary me-2 w-32">Simpan Perubahan</button>
                        {{-- <button type="button" class="btn btn-danger me-2 w-32" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus Akun</button> --}}
                        <a href="{{ url('home') }}" class="btn btn-secondary w-32">Kembali ke Halaman Utama</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Akun -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus akun ini? Semua data akan hilang dan tidak dapat dipulihkan.</p>
                    <form action="{{ route('profile.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label for="password" class="form-label">Masukkan Password untuk Verifikasi</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pesan Sukses -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Berhasil!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ session('success') }}</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('home') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pesan Tidak Ada Perubahan -->
    <div class="modal fade" id="noChangesModal" tabindex="-1" aria-labelledby="noChangesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="noChangesModalLabel">Tidak Ada Data yang Berubah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda belum melakukan perubahan apapun pada profil Anda.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Menampilkan Modal -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                var successModal = new bootstrap.Modal(document.getElementById('successModal'), {
                    keyboard: false
                });
                successModal.show();
            @elseif(session('info'))
                var noChangesModal = new bootstrap.Modal(document.getElementById('noChangesModal'), {
                    keyboard: false
                });
                noChangesModal.show();
            @endif
        });
    </script>
    @endpush

</main>
@endsection
