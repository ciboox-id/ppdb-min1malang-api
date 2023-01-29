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
                    <h5 class="card-title mt-3 mb-0">Data Alamat</h5>
                    <p className="text-gray-500 font-medium ">
                        Lengkapi data dibawah, Jika terdapat (<span class="mandatory">*</span>) maka wajib diisi
                    </p>
                    <form class="row g-3" action="{{ route('dashboard.data-alamat.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="col-sm-12 col-md-6">
                            <label for="no_kk" class="form-label">No. Kartu Keluarga <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="no_kk" value="{{ $user->address->no_kk }}" placeholder="ex: 36382547900755512">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="kelurahan" class="form-label">Kelurahan <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="kelurahan"
                                value="{{ $user->address->kelurahan }}" placeholder="ex: Sawojajar">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="kecamatan" class="form-label">Kecamatan <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $user->address->kecamatan }}"
                                name="kecamatan" placeholder="ex: Pagak">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="kota_kab" class="form-label">Kota / Kabupaten <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="kota_kab"
                                value="{{ $user->address->kota_kab }}" placeholder="ex: Malang">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="kode_pos" class="form-label">Kode Pos <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $user->address->kode_pos }}"
                                name="kode_pos" placeholder="ex: 65139">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="jarak_rumah" class="form-label">Jarak Rumah ke MIN 1 Kota Malang <span class="mandatory">*</span></label>
                            <select class="form-select" name="jarak_rumah">
                                @foreach ($jarak as $jrk)
                                    @if ($jrk == $user->jarak_rumah)
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
