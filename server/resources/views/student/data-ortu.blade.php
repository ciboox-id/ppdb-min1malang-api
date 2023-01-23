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
                <h5 class="card-title">Data Orang tua</h5>
                <form class="row g-3" action="{{ route('dashboard.data-ortu.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Nama Lengkap Ayah</label>
                        <input type="text" class="form-control" name="nama_lengkap_ayah" value="{{ $father->nama_lengkap_ayah }}">
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label">Nama Lengkap Ibu</label>
                        <input type="text" class="form-control" value="{{ $mother->nama_lengkap_ibu }}" name="nama_lengkap_ibu">
                    </div>
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">NIK Ayah</label>
                        <input type="text" class="form-control" name="nik_ayah" value="{{ $father->nik_ayah }}">
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label">NIK Ibu</label>
                        <input type="text" class="form-control" value="{{ $mother->nik_ibu }}" name="nik_ibu">
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Pekerjaan Ayah</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $father->pekerjaan_ayah }}"
                            name="pekerjaan_ayah">
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Pekerjaan Ibu</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $mother->pekerjaan_ibu }}"
                            name="pekerjaan_ibu">
                    </div>

                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Nama Kantor Ayah</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $father->nama_kantor_ayah }}"
                            name="nama_kantor_ayah">
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Nama Kantor Ibu</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $mother->nama_kantor_ibu }}"
                            name="nama_kantor_ibu">
                    </div>

                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Penghasilan Ayah</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $father->penghasilan_ayah }}"
                            name="penghasilan_ayah">
                    </div>

                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Penghasilan Ibu</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $mother->penghasilan_ibu }}"
                            name="penghasilan_ibu">
                    </div>

                    <div class="col-6">
                        <label for="inputAddress" class="form-label">No. Telp Ayah</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $father->no_telp_ayah }}"
                            name="no_telp_ayah">
                    </div>

                    <div class="col-6">
                        <label for="inputAddress" class="form-label">No. Telp Ibu</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $mother->no_telp_ibu }}"
                            name="no_telp_ibu">
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
