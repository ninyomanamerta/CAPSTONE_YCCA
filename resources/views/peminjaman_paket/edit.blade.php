@extends('layouts.master')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-2">Peminjaman Buku Paket</h1>
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
                <h4 class="card-title ml-4 mb-6">Formulir Peminjaman Buku Paket</h4>

                <!-- Horizontal Form -->
                <form action="{{ route('pinjamPaket.update', $peminjamanPaket->id) }}" method="POST" class="px-3">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="student" value="{{ $peminjamanPaket->siswa->id }}">

                    {{-- Penanggung Jawab --}}
                    <div class="row mb-3">
                        <label for="pic" class="col-sm-2 col-form-label">Penanggung Jawab</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control readonly" id="pic" name="pic" placeholder="Petugas yang meminjamkan buku" value="{{ old('pic', $peminjamanPaket->penanggung_jawab) }}" readonly required >
                        </div>
                    </div>

                    {{-- Stundet --}}
                    <div class="row mb-8">
                        <label for="student" class="col-sm-2 col-form-label">Data Siswa</label>
                        <div class="col-sm-10 ">
                            <input type="text" class="form-control readonly" name="studentAs" value="{{ $peminjamanPaket->kelas }} | {{ $peminjamanPaket->siswa->nis }} | {{ $peminjamanPaket->siswa->nama_siswa }}" readonly>
                        </div>
                    </div>

                    {{-- Data Buku Lama --}}
                    <div class="form-group">
                        <label for="books-old" class="mb-2">Buku Paket Yang Telah Dipinjam</label>
                        <ul class="list-group">
                            @foreach($peminjamanPaket->detailPeminjamanBukuPaket as $detail)
                                <input type="text" class="form-control mb-2 readonly" name="books-old" value="{{ $detail->bukuPaket->packageBook->judul }} | {{ $detail->bukuPaket->packageBook->jenis->nomor_induk_jenis }}{{ $detail->bukuPaket->packageBook->mapel->nomor_induk_mapel }}{{ optional($detail->bukuPaket->packageBook->submapel)->nomor_induk_submapel }}{{ optional($detail->bukuPaket->packageBook->subkelas)->nomor_induk_subkelas }}{{ optional($detail->bukuPaket->packageBook->subklasifikasi)->nomor_induk_klasifikasi }}{{ optional($detail->bukuPaket->packageBook->subklasifikasith)->nomor_induk_klasifikasi4 }}.{{ str_pad($detail->bukuPaket->nomor_induk, 4, '0', STR_PAD_LEFT) }}" readonly>

                            @endforeach
                        </ul>
                    </div>



                    {{-- Add Buku Paket --}}
                    <div class="row mb-2 mt-3">
                        <label for="books" class="col-form-label">Buku Paket Yang Ditambahkan <span> | Total Yang Ditambahkan <span id="bookCount">: 1 </span> </span> </label>
                        <div class="col-10 mt-1 mb-2" id="select-container">
                            <select class="form-control select2Books" name="books[]" style="width: 110%; margin-left: 14px;" id="books_1">
                                <option value="">Pilih opsi</option>
                                @foreach($books as $book)
                                    @foreach($book->detailPackageBooks as $detail)
                                        @if($detail->status_peminjaman === 'available')
                                            <option value="{{ $detail->id }}">
                                                {{ $book->judul }} | {{ $book->jenis->nomor_induk_jenis }}{{ $book->mapel->nomor_induk_mapel }}{{ optional($book->submapel)->nomor_induk_submapel }}{{ optional($book->subkelas)->nomor_induk_subkelas }}{{ optional($book->subklasifikasi)->nomor_induk_klasifikasi}}{{ optional($book->subklasifikasith)->nomor_induk_klasifikasi4 }}.{{ str_pad($detail->nomor_induk, 4, '0', STR_PAD_LEFT) }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="col-2 mb-2 d-flex justify-content-end">
                            <button type="button" onclick="addRow()" class="btn btn-primary w-14" style="height: 42px; margin-top: 3px;">
                                <i class="bi bi-plus" style="font-size: 20px;"></i>
                            </button>
                        </div>
                    </div>

                    <div id="additionalRows"></div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pinjamPaket.detail', $peminjamanPaket->siswa->id ) }}" class="mt-2 btn btn-warning mb-2">Batal</a>
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
        $('.select2').select2({
            theme: 'bootstrap5',
            placeholder: "Pilih nama siswa",
            allowClear: true,
            language: {
                inputTooShort: function() {
                    return "Cari nama siswa";
                }
            }
        });

        $('.select2Books').select2({
            theme: 'bootstrap5',
            placeholder: "Pilih buku paket",
            allowClear: true,
            language: {
                inputTooShort: function() {
                    return "Cari buku paket";
                }
            }
        });
    });

    // function add row
    var rowCounter = 1;

    function addRow() {
        rowCounter++;

        var newRow = document.createElement('div');
        newRow.classList.add('mb-2', 'd-flex', 'row', 'books-row');

        var selectContainer = document.createElement('div');
        selectContainer.classList.add('col-10', 'mb-2');
        selectContainer.innerHTML = `
           <select class="form-control select2Books" name="books[]" id="books_${rowCounter}" style="width: 110%;">
            <option value="">Pilih opsi</option>
            @foreach($books as $book)
                @foreach($book->detailPackageBooks as $detail)
                    @if($detail->status_peminjaman === 'available')
                        <option value="{{ $detail->id }}">
                            {{ $book->judul }} | {{ str_pad($detail->nomor_induk, 4, '0', STR_PAD_LEFT) }}
                        </option>
                    @endif
                @endforeach
            @endforeach
        </select>
        `;
        newRow.appendChild(selectContainer);

        var removeButtonContainer = document.createElement('div');
        removeButtonContainer.classList.add('col-2', 'mb-2', 'd-flex', 'justify-content-end');
        removeButtonContainer.innerHTML = `
            <button type="button" onclick="removeRow(this)" class="btn btn-danger w-14" style="height: 42px;">
                <i class="bi bi-dash" style="font-size: 20px;"></i>
            </button>
        `;
        newRow.appendChild(removeButtonContainer);

        document.getElementById('additionalRows').appendChild(newRow);

        $(`#books_${rowCounter}`).select2({
            theme: 'bootstrap5',
            placeholder: "Pilih buku paket",
            allowClear: true,
            language: {
                inputTooShort: function() {
                    return "Cari buku paket";
                }
            }
        });

        updateBookCount();
    }

    function removeRow(button) {
        var rowToRemove = button.closest('.books-row');
        if (rowToRemove) {
            rowToRemove.remove();
        } else {
            console.log('No row found to remove');
        }

        updateBookCount();
    }

    function updateBookCount() {
        var bookCount = document.querySelectorAll('#additionalRows .books-row').length + 1;
        document.getElementById('bookCount').innerText = ": " + bookCount;
    }

</script>
@endpush
