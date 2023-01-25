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
                <h5 class="card-title mt-4 mb-0">Identitas diri</h5>
                <p className="text-gray-500 font-medium ">
                    Lengkapi data dibawah, Jika terdapat <span className="text-red-600">(*)</span> maka wajib diisi
                </p>
                <form class="row g-3" action="{{ route('dashboard.data-umum.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="col-sm-12 col-md-6">
                        <label for="inputNanme4" class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-control" name="nama_lengkap" value="{{ $user->nama_lengkap }}">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputEmail4" class="form-label">Anak ke *</label>
                        <input type="number" class="form-control" value="{{ $user->anak_ke }}" name="anak_ke">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="category" class="form-label">Jenis Kelamin *</label>
                        <select class="form-select" name="jenis_kelamin">
                            <option value="Laki-laki" @if ($user->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki</option>
                            <option value="Perempuan" @if ($user->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">NISN *</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->nisn }}"
                            name="nisn">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Alamat Siswa *</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->alamat_siswa }}"
                            name="alamat_siswa">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="category" class="form-label">Golongan Darah *</label>
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
                        <label for="inputAddress" class="form-label">Tempat Lahir *</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->tempat_lahir }}"
                            name="tempat_lahir">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Tanggal Lahir *</label>
                        <input type="date" class="form-control" id="inputAddress" value="{{ $user->tanggal_lahir }}"
                            name="tanggal_lahir">
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
