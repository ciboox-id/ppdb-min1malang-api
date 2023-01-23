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
                <h5 class="card-title">Data Sekolah</h5>
                <form class="row g-3" action="{{ route('dashboard.data-sekolah.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control" name="nama_sekolah" value="{{ $school->nama_sekolah }}">
                    </div>
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Asal Sekolah</label>
                        <input type="text" class="form-control" name="asal_sekolah" value="{{ $school->asal_sekolah }}">
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label">npsn</label>
                        <input type="text" class="form-control" value="{{ $school->npsn }}" name="npsn">
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
