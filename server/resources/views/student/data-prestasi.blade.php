@extends('layouts.main')

@section('container')
    <div class="col-12">

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                @if (auth()->user()->jalur)
                    @if (auth()->user()->jalur === 'reguler' || auth()->user()->jalur === 'prestasi')
                        <h5 class="card-title mt-3">Upload Sertifikat Prestasi</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="bi bi-plus-square"></i>
                            Tambah prestasi
                        </button>
                    @elseif(auth()->user()->jalur === 'tahfidz')
                        <h5 class="card-title mt-3">Upload sertifikat tahfidz</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop1">
                            <i class="bi bi-cloud-upload"></i>
                            Upload sertifikat
                        </button>
                    @else
                        <h5 class="card-title mt-3">Upload surat keterangan dari Kelurahan</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop2">
                            <i class="bi bi-cloud-upload"></i>
                            Upload
                        </button>
                    @endif

                    <div class=" overflow-auto">
                        <table class="table table-borderless datatable mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Sertifikat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($prestasi) > 0)
                                    @foreach ($prestasi as $pres)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $pres->prestasi }}</td>
                                            <td class="d-flex">
                                                <a href="{{ asset($pres->sertifikat) }}" target="_blank"
                                                    rel="noopener noreferrer">
                                                    <i class="bi bi-eye-fill"></i>
                                                    Lihat foto
                                                </a>
                                            </td>
                                            <td>
                                                <div>
                                                    <form
                                                        action="{{ route('dashboard.data-prestasi.delete', ['id' => $pres->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="badge rounded-pill bg-danger">
                                                            <i class="bi bi-trash"></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>Belum ada data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-danger mt-4 mb-0" role="alert">
                        <i class="bi bi-exclamation-circle"></i>
                        Silahkan memilih jalur pendaftaran terlebih dahulu! <a href="{{ route('dashboard.siswa') }}">Klik
                            disini</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal1 -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Prestasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('dashboard.data-prestasi.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Prestasi</label>
                            <input type="text" class="form-control" name="prestasi"
                                placeholder="ex: Juara 1 lomba olimpiade matematika">
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Tingkat</label>
                            <select class="form-select" name="tingkat">
                                @foreach ($tingkat as $tgkt)
                                    <option value="{{ $tgkt }}" selected> {{ $tgkt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="foto_siswa" class="form-label">Sertifikat</label>
                            <input class="form-control" type="file" id="sertifikat" name="sertifikat">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal 2 --}}
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Sertifikat Tahfidz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('dashboard.data-prestasi.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Nama Sertifikat</label>
                            <input type="text" class="form-control" name="prestasi"
                                placeholder="ex: Sertifikat tahfidz pondok ...">
                        </div>
                        <div class="col-12">
                            <label for="foto_siswa" class="form-label">Sertifikat</label>
                            <input class="form-control" type="file" id="sertifikat" name="sertifikat">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                            Upload
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal 3 --}}
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Surat Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('dashboard.data-prestasi.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Jenis surat</label>
                            <input type="text" class="form-control" name="prestasi"
                                placeholder="ex: Surat keterangan dari kelurahan">
                        </div>
                        <div class="col-12">
                            <label for="foto_siswa" class="form-label">Surat Keterangan</label>
                            <input class="form-control" type="file" id="sertifikat" name="sertifikat">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                            Upload
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
