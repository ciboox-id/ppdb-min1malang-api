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
                @if ($user->jalur != null)
                <h5 class="card-title">Data Sekolah</h5>
                <p className="text-gray-500 font-medium ">
                    Lengkapi data dibawah, Jika terdapat <span className="text-red-600">(*)</span> maka wajib diisi
                </p>
                <form class="row g-3" action="{{ route('dashboard.data-sekolah.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="col-sm-12 col-md-6">
                        <label for="inputNanme4" class="form-label">Nama Sekolah *</label>
                        <input type="text" class="form-control" name="nama_sekolah" value="{{ $user->school->nama_sekolah }}">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputNanme4" class="form-label">Asal Sekolah *</label>
                        <input type="text" class="form-control" name="asal_sekolah" value="{{ $user->school->asal_sekolah }}">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputEmail4" class="form-label">NPSN *</label>
                        <input type="text" class="form-control" value="{{ $user->school->npsn }}" name="npsn">
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                        Simpan Perubahan
                    </button>
                </form>

                @else
                    <div class="alert alert-danger mt-4 mb-0" role="alert">
                        <i class="bi bi-exclamation-circle"></i>
                        Silahkan memilih jalur pendaftaran terlebih dahulu! <a href="{{ route('dashboard.siswa') }}">Klik disini</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
