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
                    <h5 class="card-title mt-4 mb-0">Identitas diri</h5>
                    <p className="text-gray-500 font-medium ">
                        Lengkapi data dibawah, Jika terdapat <span className="text-red-600">(*)</span> maka wajib diisi
                    </p>
                    <form class="row g-3" action="{{ route('dashboard.data-umum.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="col-sm-12 col-md-6">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap *</label>
                            <input type="text" class="form-control" name="nama_lengkap"
                                value="{{ $user->nama_lengkap }}" placeholder="ex: ciboox.id" style="text-transform: uppercase">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="anak_ke" class="form-label">Anak ke *</label>
                            <input type="number" class="form-control" value="{{ $user->anak_ke }}" name="anak_ke" placeholder="ex: 1">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="category" class="form-label">Jenis Kelamin *</label>
                            <select class="form-select" name="jenis_kelamin">
                                <option value="Laki-laki" @if ($user->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki
                                </option>
                                <option value="Perempuan" @if ($user->jenis_kelamin == 'Perempuan') selected @endif>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nisn" class="form-label">NISN *</label>
                            <input type="text" class="form-control" id="inputAddress" value="{{ $user->nisn }}"
                                name="nisn" placeholder="ex: 2163688232">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="alamat_siswa" class="form-label">Alamat Siswa *</label>
                            <input type="text" class="form-control" id="alamat_siswa" value="{{ $user->alamat_siswa }}"
                                name="alamat_siswa" placeholder="ex: Jln Danau Ranau">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="gol_darah" class="form-label">Golongan Darah *</label>
                            <select class="form-select" name="gol_darah">
                                @foreach ($gol_darah as $gol)
                                    @if ($gol === $user->gol_darah)
                                        <option value="{{ $gol }}" selected> {{ $gol }}</option>
                                    @else
                                        <option value="{{ $gol }}"> {{ $gol }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir *</label>
                            <input type="text" class="form-control" id="tempat_lahir" value="{{ $user->tempat_lahir }}"
                                name="tempat_lahir" placeholder="ex: Malang">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir *</label>
                            <input type="date" class="form-control" id="tanggal_lahir" value="{{ $user->tanggal_lahir }}"
                                name="tanggal_lahir">
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
