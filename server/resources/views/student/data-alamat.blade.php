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
                @if ($user->jalur)
                    <h5 class="card-title mt-4 mb-0">Data Alamat</h5>
                    <p className="text-gray-500 font-medium ">
                        Lengkapi data dibawah, Jika terdapat <span className="text-red-600">(*)</span> maka wajib diisi
                    </p>
                    <form class="row g-3" action="{{ route('dashboard.data-alamat.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="col-sm-12 col-md-6">
                            <label for="inputNanme4" class="form-label">No. Kartu Keluarga</label>
                            <input type="text" class="form-control" name="no_kk" value="{{ $user->address->no_kk }}">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="inputNanme4" class="form-label">Kelurahan</label>
                            <input type="text" class="form-control" name="kelurahan"
                                value="{{ $user->address->kelurahan }}">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="inputEmail4" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" value="{{ $user->address->kecamatan }}"
                                name="kecamatan">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="inputNanme4" class="form-label">Kota / Kabupaten</label>
                            <input type="text" class="form-control" name="kota_kab"
                                value="{{ $user->address->kota_kab }}">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="inputEmail4" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" value="{{ $user->address->kode_pos }}"
                                name="kode_pos">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="inputEmail4" class="form-label">Jarak Rumah ke MIN 1 Kota Malang</label>
                            <select class="form-select" name="jarak_rumah">
                                @foreach ($jarak as $jrk)
                                    @if ($jrk === $user->jarak_rumah)
                                        <option value="{{ $jrk }}" selected> {{ $jrk }}</option>
                                    @else
                                        <option value="{{ $jrk }}"> {{ $jrk }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                            Simpan Perubahan
                        </button>
                    </form>
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
@endsection
