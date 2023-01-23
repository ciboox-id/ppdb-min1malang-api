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
                <h5 class="card-title">Data Berkas</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah prestasi
                </button>
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
                                    <label for="inputNanme4" class="form-label">No. Kartu Keluarga</label>
                                    <input type="text" class="form-control" name="no_kk" value="{{ $address->no_kk }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Kelurahan</label>
                                    <input type="text" class="form-control" name="kelurahan"
                                        value="{{ $address->kelurahan }}">
                                </div>
                                <div class="col-12">
                                    <label for="foto_siswa" class="form-label">Foto Siswa</label>
                                    <input class="form-control" type="file" id="foto_siswa" accept="image/*"
                                        name="foto_siswa">
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
