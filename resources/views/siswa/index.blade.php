@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Siswa</h1>

        <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
            <a href="{{ route('student.create') }}" class="btn btn-primary">Tambah Siswa</a>
            <span class="ml-2"><a href="{{ route('student.import') }}" class="btn btn-success"><i class="bi bi-file-earmark-plus-fill"></i></a></span>
        </div>

        @if(Session::has('success'))
        <div class="alert alert-success" role="alert" style="padding-top:10px">
            {{ Session::get('success') }}
        </div>
        @endif
    </div><!-- End Page Title -->

    <section class="section dashboard mt-4">
        <div class="row">
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
                                    <th scope="col">Tk I</th>
                                    <th scope="col">Tk II</th>
                                    <th scope="col">Tk III</th>
                                    <th scope="col" style="display: flex; justify-content: flex-end;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $index => $student)
                                <tr>
                                    <th scope="row" class="col-1">{{ $index + 1 }}</th>
                                    <td class="col-2">{{ $student->nis }}</td>
                                    <td class="col-3">{{ $student->nama_siswa }}</td>

                                    <td class="col-1">
                                        @php
                                            $kelas = $student->detailSiswa->where('tingkat', 7)->first();
                                        @endphp

                                        @if($kelas)
                                            @if($kelas->current_class)
                                                <span class="student">{{ $kelas->tingkat }}{{ $kelas->kelas }}</span>
                                            @else
                                                {{ $kelas->tingkat }}{{ $kelas->kelas }}
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td class="col-1">
                                        @php
                                            $kelas = $student->detailSiswa->where('tingkat', 8)->first();
                                        @endphp

                                        @if($kelas)
                                            @if($kelas->current_class)
                                                <span class="student">{{ $kelas->tingkat }}{{ $kelas->kelas }}</span>
                                            @else
                                                {{ $kelas->tingkat }}{{ $kelas->kelas }}
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td class="col-1">
                                        @php
                                            $kelas = $student->detailSiswa->where('tingkat', 9)->first();
                                        @endphp

                                        @if($kelas)
                                            @if($kelas->current_class)
                                                <span class="student">{{ $kelas->tingkat }}{{ $kelas->kelas }}</span>
                                            @else
                                                {{ $kelas->tingkat }}{{ $kelas->kelas }}
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td class="col-0" style="display: flex; justify-content: flex-end;">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#studentModal" data-id="{{ $student->id }}" class="view-student"><span class="badge bg-success">View</span></a>
                                        <a href="{{ route('student.edit', $student->id) }}"><span class="badge bg-warning">Update</span></a>
                                        <a href="#" class="badge bg-danger delete-student" data-id="{{ $student->id }}" data-name="{{ $student->nama_siswa }}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div><!-- End Recent Sales -->

            <!-- Modal Detail Siswa -->
            <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="studentModalLabel">Detail Siswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>NIS Siswa:</strong> <span id="modal-nis"></span></p>
                            <p><strong>Nama Siswa:</strong> <span id="modal-nama"></span></p>
                            <p><strong>Kelas Saat Ini:</strong> <span id="modal-kelas"></span></p>
                            <p><strong>Tanggal Dibuat:</strong> <span id="modal-tanggal"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Konfirmasi Delete -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus data siswa <strong id="delete-student-name"></strong>? Dengan menghapus data siswa, maka semua data peminjaman terkait akan dihapus.</p>
                        </div>
                        <div class="modal-footer">
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Script -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
            <script>
                $(document).ready(function() {

                    // View detail siswa
                    $('.view-student').on('click', function() {
                        $('#modal-nis').text('Loading...');
                        $('#modal-nama').text('Loading...');
                        $('#modal-kelas').text('Loading...');
                        $('#modal-tanggal').text('Loading...');

                        var studentId = $(this).data('id');
                        $.ajax({
                            url: '/siswa/' + studentId,
                            method: 'GET',
                            success: function(data) {
                                $('#modal-nis').text(data.nis);
                                $('#modal-nama').text(data.nama_siswa);

                                let currentClassDetail = data.kelas.find(function(detail) {
                                    return detail.current_class === 'Yes';
                                });

                                if (currentClassDetail) {
                                    $('#modal-kelas').text(currentClassDetail.tingkat.toString() + currentClassDetail.kelas);
                                } else {
                                    $('#modal-kelas').text('N/A');
                                }

                                //$('#modal-kelas').text(data.kelas);

                                // Format tanggal
                                const date = new Date(data.created_at);
                                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                                $('#modal-tanggal').text(date.toLocaleDateString(undefined, options));
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                            }
                        });
                    });

                    // Delete siswa
                    $('.delete-student').on('click', function(e) {
                        e.preventDefault();
                        var studentId = $(this).data('id');
                        var studentName = $(this).data('name');
                        $('#delete-student-name').text(studentName);
                        $('#deleteForm').attr('action', '/siswa/' + studentId);
                        $('#deleteModal').modal('show');
                    });
                });
            </script>

        </div>
    </section>

</main>

@endsection
