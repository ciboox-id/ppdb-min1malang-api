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
                    <h5 class="card-title mt-3 mb-0">Data Orang tua</h5>
                    <p className="text-gray-500 font-medium ">
                        Lengkapi data dibawah, Jika terdapat <span className="text-red-600">(*)</span> maka wajib diisi
                    </p>
                    <form class="row g-3" action="{{ route('dashboard.data-ortu.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="col-sm-12 col-md-6">
                            <label for="nama_lengkap_ayah" class="form-label">Nama Lengkap Ayah *</label>
                            <input type="text" class="form-control" name="nama_lengkap_ayah" placeholder="ex: Budi Setyawan"
                                value="{{ $father->nama_lengkap_ayah }}">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nama_lengkap_ibu" class="form-label">Nama Lengkap Ibu *</label>
                            <input type="text" class="form-control" value="{{ $mother->nama_lengkap_ibu }}"
                                name="nama_lengkap_ibu" placeholder="ex: Putri Tjisaka">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nik_ayah" class="form-label">NIK Ayah *</label>
                            <input type="text" class="form-control" name="nik_ayah" value="{{ $father->nik_ayah }}" placeholder="ex: 213521376182367">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nik_ibu" class="form-label">NIK Ibu *</label>
                            <input type="text" class="form-control" value="{{ $mother->nik_ibu }}" name="nik_ibu" placeholder="ex: 123721596236">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah *</label>
                            <input type="text" class="form-control"
                                value="{{ $father->pekerjaan_ayah }}" name="pekerjaan_ayah" placeholder="ex: Petani">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu *</label>
                            <input type="text" class="form-control"
                                value="{{ $mother->pekerjaan_ibu }}" name="pekerjaan_ibu" placeholder="ex: Ibu rumah tangga">
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="nama_kantor_ayah" class="form-label">Nama Kantor Ayah *</label>
                            <input type="text" class="form-control"
                                value="{{ $father->nama_kantor_ayah }}" name="nama_kantor_ayah" placeholder="ex: Sawah">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nama_kantor_ibu" class="form-label">Nama Kantor Ibu *</label>
                            <input type="text" class="form-control"
                                value="{{ $mother->nama_kantor_ibu }}" name="nama_kantor_ibu" placeholder="ex: Rumah">
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah *</label>
                            <select class="form-select" name="penghasilan_ayah">
                                @foreach ($salary as $item)
                                    @if ($item == $user->penghasilan_ayah)
                                        <option value="{{ $item }}" selected> {{ $item }}</option>
                                    @else
                                        <option value="{{ $item }}"> {{ $item }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu *</label>
                            <select class="form-select" name="penghasilan_ibu">
                                @foreach ($salary as $item)
                                    @if ($item == $user->penghasilan_ibu)
                                        <option value="{{ $item }}" selected> {{ $item }}</option>
                                    @else
                                        <option value="{{ $item }}"> {{ $item }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="no_telp_ayah" class="form-label">No. Telp Ayah *</label>
                            <input type="text" class="form-control"
                                value="{{ $father->no_telp_ayah }}" name="no_telp_ayah" placeholder="ex: 08213526135">
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="no_telp_ibu" class="form-label">No. Telp Ibu *</label>
                            <input type="text" class="form-control"
                                value="{{ $mother->no_telp_ibu }}" name="no_telp_ibu" placeholder="ex: 08213526135">
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
