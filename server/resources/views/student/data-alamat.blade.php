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
                <h5 class="card-title">Data Alamat</h5>
                <form class="row g-3" action="{{ route('dashboard.data-alamat.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">No. Kartu Keluarga</label>
                        <input type="text" class="form-control" name="no_kk" value="{{ $address->no_kk }}">
                    </div>
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" name="kelurahan" value="{{ $address->kelurahan }}">
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" value="{{ $address->kecamatan }}" name="kecamatan">
                    </div>
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Kota / Kabupaten</label>
                        <input type="text" class="form-control" name="kota_kab" value="{{ $address->kota_kab }}">
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" value="{{ $address->kode_pos }}" name="kode_pos">
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
