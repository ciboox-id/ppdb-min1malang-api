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
                <h5 class="card-title">Data Prestasi</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="bi bi-plus-square"></i>
                    Tambah prestasi
                </button>

                <div class=" overflow-auto">
                    <table class="table table-borderless datatable mt-4">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Prestasi</th>
                                <th scope="col">Tingkat</th>
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
                                        <td>{{ $pres->tingkat }}</td>
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
                                    <td>Belum ada data siswa</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Prestas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('dashboard.data-prestasi.update') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Prestasi</label>
                            <input type="text" class="form-control" name="prestasi"
                                placeholder="ex: Juara 1 lomba olimpiade matematika">
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Tingkat</label>
                            <input type="text" class="form-control" name="tingkat" placeholder="ex: Provinsi">
                        </div>
                        <div class="col-12">
                            <label for="foto_siswa" class="form-label">Sertifikat</label>
                            <input class="form-control" type="file" id="sertifikat" accept="image/*" name="sertifikat">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                            Tambah Prestasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
