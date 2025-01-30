@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-2">Tambah Data Buku Pengayaan</h1>
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
                <h4 class="card-title ml-4 mb-6">Formulir Tambah Buku Pengayaan</h4>

                <!-- Horizontal Form -->
                <form action="{{ route('enrichmentBooks.store') }}" method="POST" class="px-3">
                    @csrf

                    <div class="row mb-3">
                        <label for="tgl_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" required value="{{ old('tgl_masuk') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul" name="judul" required value="{{ old('judul') }}" placeholder="Masukan judul buku">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pengarang" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kategori" name="kategori" required value="{{ old('kategori') }}" placeholder="Masukan kategori buku">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_jenis" class="col-sm-2 col-form-label">Klasifikasi Jenis</label>
                        <div class="col-sm-10">
                            <select class="form-control select2Jenis" id="klasifikasi_jenis" name="klasifikasi_jenis" required>
                                <option value="">Pilih Jenis</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->jenis_buku }} - {{ $type->nomor_induk_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_mapel" class="col-sm-2 col-form-label">Klasifikasi Mapel</label>
                        <div class="col-sm-10">
                            <select class="form-control select2Mapel" id="klasifikasi_mapel" name="klasifikasi_mapel" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->mapel }} - {{ $course->nomor_induk_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_submapel" class="col-sm-2 col-form-label">Klasifikasi Sub I</label>
                        <div class="col-sm-10">
                            <select class="form-control select2SubI" id="klasifikasi_submapel" name="klasifikasi_submapel">
                                <option value="">Pilih Sub I (Opsional)</option>
                                @foreach($subCourses as $subCourse)
                                    <option value="{{ $subCourse->id }}">{{ $subCourse->sub_mapel }} - {{ $subCourse->nomor_induk_submapel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_subkelas" class="col-sm-2 col-form-label">Klasifikasi Sub II</label>
                        <div class="col-sm-10">
                            <select class="form-control select2SubII" id="klasifikasi_subkelas" name="klasifikasi_subkelas">
                                <option value="">Pilih Sub II (Opsional)</option>
                                @foreach($subClasses as $subClass)
                                    <option value="{{ $subClass->id }}">{{ $subClass->sub_kelas }} - {{ $subClass->nomor_induk_subkelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_subclasification" class="col-sm-2 col-form-label">Klasifikasi Sub III</label>
                        <div class="col-sm-10">
                            <select class="form-control select2SubIII" id="klasifikasi_subclasification" name="klasifikasi_subclasification">
                                <option value="">Pilih Sub III (Opsional)</option>
                                @foreach($subClasification as $subClasification)
                                    <option value="{{ $subClasification->id }}">{{ $subClasification->klasifikasi }} - {{ $subClasification->nomor_induk_klasifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_subclasificationth" class="col-sm-2 col-form-label">Klasifikasi Sub IV</label>
                        <div class="col-sm-10">
                            <select class="form-control select2SubIV" id="klasifikasi_subclasificationth" name="klasifikasi_subclasificationth">
                                <option value="">Pilih Sub IV (Opsional)</option>
                                @foreach($subClasificationTh as $subClasificationTh)
                                    <option value="{{ $subClasificationTh->id }}">{{ $subClasificationTh->klasifikasi4 }} - {{ $subClasificationTh->nomor_induk_klasifikasi4 }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pengarang" name="pengarang" required value="{{ old('pengarang') }}" placeholder="Masukan pengarang buku">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="penerbit" name="penerbit" required value="{{ old('penerbit') }}" placeholder="Masukan penerbit buku">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                        <div class="col-sm-10">
                            <input type="integer" class="form-control" id="tahun" name="tahun" required value="{{ old('tahun') }}" placeholder="Masukan tahun terbit buku">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jumlah" class="col-sm-2 col-form-label">Eksemplar</label>
                        <div class="col-sm-10">
                            <input type="integer" class="form-control" id="eksemplar" name="eksemplar" required value="{{ old('eksemplar') }}" placeholder="Masukan jumlah buku">
                        </div>
                    </div>

                    <!-- Dropdown untuk memilih Rak -->
                    <div class="row mb-3">
                        <label for="id_rak" class="col-sm-2 col-form-label">Rak</label>
                        <div class="col-sm-10">
                            <select class="form-control select2Rak" id="id_rak" name="id_rak" required>
                                <option value="">Pilih Rak</option>
                                @foreach($bookcases as $bookcase)
                                    <option value="{{ $bookcase->id }}" {{ old('id_rak') == $bookcase->id ? 'selected' : '' }}>
                                        Rak {{ $bookcase->lokasi ?? 'Nama Rak Tidak Tersedia' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('enrichmentBooks.index') }}" class="mt-2 btn btn-warning mb-2">Batal</a>
                    </div>
                </form><!-- End Horizontal Form -->

            </div>
        </div>

    </div>
</main>

@endsection

@push('scripts')
<script>

    $(document).ready(function() {
        $('.select2Jenis').select2({
            theme: 'bootstrap5',
            placeholder: "Pilih atau cari klasifikasi jenis",
            allowClear: true,
            language: {
                inputTooShort: function() {
                    return "Pilih atau cari klasifikasi jenis";
                }
            }
        });

        $('.select2Mapel').select2({
            theme: 'bootstrap5',
            placeholder: "Pilih atau cari klasifikasi mapel",
            allowClear: true,
            language: {
                inputTooShort: function() {
                    return "Pilih atau cari klasifikasi mapel";
                }
            }
        });

        $('.select2SubI').select2({
            theme: 'bootstrap5',
            placeholder: "Pilih atau cari klasifikasi sub I (opsional)",
            allowClear: true,
            language: {
                inputTooShort: function() {
                    return "Pilih atau cari klasifikasi sub I (opsional)";
                }
            }
        });

        $('.select2SubII').select2({
            theme: 'bootstrap5',
            placeholder: "Pilih atau cari klasifikasi sub II (opsional)",
            allowClear: true,
            language: {
                inputTooShort: function() {
                    return "Pilih atau cari klasifikasi sub II (opsional)";
                }
            }
        });

        $('.select2SubIII').select2({
            theme: 'bootstrap5',
            placeholder: "Pilih atau cari klasifikasi sub III (opsional)",
            allowClear: true,
            language: {
                inputTooShort: function() {
                    return "Pilih atau cari klasifikasi sub III (opsional)";
                }
            }
        });

        $('.select2SubIV').select2({
            theme: 'bootstrap5',
            placeholder: "Pilih atau cari klasifikasi sub IV (opsional)",
            allowClear: true,
            language: {
                inputTooShort: function() {
                    return "Pilih atau cari klasifikasi sub IV (opsional)";
                }
            }
        });

        $('.select2Rak').select2({
            theme: 'bootstrap5',
            placeholder: "Pilih atau cari rak",
            allowClear: true,
            language: {
                inputTooShort: function() {
                    return "Pilih atau cari rak";
                }
            }
        });
    });

</script>
@endpush
