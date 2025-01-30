@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-2">Edit Data Buku Pengayaan</h1>
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
                <h4 class="card-title ml-4 mb-6">Formulir Edit Buku Pengayaan</h4>

                <!-- Horizontal Form -->
                <form action="{{ route('enrichmentBooks.update', $enrichmentBooks->id) }}" method="POST" class="px-3">
                    @csrf
                    @method('PUT') <!-- Menandakan ini adalah update request -->

                    <div class="row mb-3">
                        <label for="tgl_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" required value="{{ old('tgl_masuk', $enrichmentBooks->tgl_masuk) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul" name="judul" required value="{{ old('judul', $enrichmentBooks->judul) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pengarang" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kategori" name="kategori" required value="{{ old('pengarang', $enrichmentBooks->kategori) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_jenis" class="col-sm-2 col-form-label">Klasifikasi Jenis</label>
                        <div class="col-sm-10">
                            <select class="form-control select2Jenis" id="klasifikasi_jenis" name="klasifikasi_jenis" required>
                                <option value="">Pilih Jenis</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ old('klasifikasi_jenis', $enrichmentBooks->id_jenis) == $type->id ? 'selected' : '' }}>{{ $type->jenis_buku }} - {{ $type->nomor_induk_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_mapel" class="col-sm-2 col-form-label">Klasifikasi Mapel</label>
                        <div class="col-sm-10">
                            <select class="form-control select2Mapel" id="klasifikasi_mapel" name="klasifikasi_mapel" required>
                                <option value="{{ $enrichmentBooks->mapel->mapel }}">Pilih Mata Pelajaran</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('klasifikasi_mapel', $enrichmentBooks->id_mapel) == $course->id ? 'selected' : '' }}>{{ $course->mapel }} - {{ $course->nomor_induk_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_submapel" class="col-sm-2 col-form-label">Klasifikasi Sub I</label>
                        <div class="col-sm-10">
                            <select class="form-control select2SubI" id="klasifikasi_submapel" name="klasifikasi_submapel">
                                <option value="">Pilih Sub I</option>
                                @foreach($subCourses as $subCourse)
                                    <option value="{{ $subCourse->id }}" {{ old('klasifikasi_submapel', $enrichmentBooks->id_submapel) == $subCourse->id ? 'selected' : '' }}>{{ $subCourse->sub_mapel }} - {{ $subCourse->nomor_induk_submapel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_subkelas" class="col-sm-2 col-form-label">Klasifikasi Sub II</label>
                        <div class="col-sm-10">
                            <select class="form-control select2SubII" id="klasifikasi_subkelas" name="klasifikasi_subkelas">
                                <option value="">Pilih Sub II</option>
                                @foreach($subClasses as $subClass)
                                    <option value="{{ $subClass->id }}" {{ old('klasifikasi_subkelas', $enrichmentBooks->id_subkelas) == $subClass->id ? 'selected' : '' }}>{{ $subClass->sub_kelas }} - {{ $subClass->nomor_induk_subkelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_subclasification" class="col-sm-2 col-form-label">Klasifikasi Sub III</label>
                        <div class="col-sm-10">
                            <select class="form-control select2SubIII" id="klasifikasi_subclasification" name="klasifikasi_subclasification">
                                <option value="">Pilih Sub III</option>
                                @foreach($subClasification as $subClasification)
                                    <option value="{{ $subClasification->id }}" {{ old('klasifikasi_subclasification', $enrichmentBooks->id_subklasifikasi) == $subClasification->id ? 'selected' : '' }}>{{ $subClasification->klasifikasi }} - {{ $subClasification->nomor_induk_klasifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="klasifikasi_subclasificationth" class="col-sm-2 col-form-label">Klasifikasi Sub IV</label>
                        <div class="col-sm-10">
                            <select class="form-control select2SubIV" id="klasifikasi_subclasificationth" name="klasifikasi_subclasificationth">
                                <option value="">Pilih Sub IV</option>
                                @foreach($subClasificationTh as $subClasificationTh)
                                    <option value="{{ $subClasificationTh->id }}" {{ old('klasifikasi_subclasificationth', $enrichmentBooks->id_subklasifikasith) == $subClasificationTh->id ? 'selected' : '' }}>{{ $subClasificationTh->klasifikasi4 }} - {{ $subClasificationTh->nomor_induk_klasifikasi4 }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pengarang" name="pengarang" required value="{{ old('pengarang', $enrichmentBooks->pengarang) }}">
                        </div>
                    </div>



                    <div class="row mb-3">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="penerbit" name="penerbit" required value="{{ old('penerbit', $enrichmentBooks->penerbit) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="tahun" name="tahun" required value="{{ old('tahun', $enrichmentBooks->tahun) }}">
                        </div>
                    </div>

                    {{-- <div class="row mb-3">
                        <label for="jumlah" class="col-sm-2 col-form-label">Eksemplar</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="eksemplar" name="eksemplar" required value="{{ old('eksemplar', $enrichmentBooks->eksemplar) }}" readonly style="background-color: #adb5bd;">
                        </div>
                    </div> --}}


                    <!-- Dropdown untuk memilih Rak -->
                    <div class="row mb-3">
                        <label for="id_rak" class="col-sm-2 col-form-label">Rak</label>
                        <div class="col-sm-10">
                            <select class="form-control select2Rak" id="id_rak" name="id_rak" required>
                                <option value="">Pilih Rak</option>
                                @foreach($bookcases as $bookcase)
                                    <option value="{{ $bookcase->id }}" {{ old('id_rak', $enrichmentBooks->id_rak) == $bookcase->id ? 'selected' : '' }}>
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
