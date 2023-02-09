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
                <form action="{{ route('dashboard.data-siswa.update', ['user' => $user->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <h5 class="card-title mt-2">Identitas diri</h5>
                    <div class="row g-3">
                        <div class="col-sm-12 col-md-6">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ $user->nama_lengkap }}"
                                placeholder="ex: ciboox.id" style="text-transform: uppercase" >
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="anak_ke" class="form-label">Anak ke <span class="mandatory">*</span></label>
                            <input type="number" class="form-control" value="{{ $user->anak_ke }}" name="anak_ke"
                                placeholder="ex: 1" >
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="category" class="form-label">Jenis Kelamin <span class="mandatory">*</span></label>
                            <select class="form-select" name="jenis_kelamin" >
                                <option value="Laki-laki" @if ($user->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki
                                </option>
                                <option value="Perempuan" @if ($user->jenis_kelamin == 'Perempuan') selected @endif>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="inputAddress" value="{{ $user->nisn }}"
                                name="nisn" placeholder="ex: 2163688232">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nik"class="form-label">NIK</label>
                            <input type="text" class="form-control" id="inputAddress" value="{{ $user->nik }}"
                                name="nik" placeholder="ex: 2163688232" maxlength="16">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="alamat_siswa" class="form-label">Alamat Siswa <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" id="alamat_siswa" value="{{ $user->alamat_siswa }}"
                                name="alamat_siswa" placeholder="ex: Jln Danau Ranau" >
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="gol_darah" class="form-label">Golongan Darah <span
                                    class="mandatory">*</span></label>
                            <select class="form-select" name="gol_darah" >
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
                            <label for="tempat_lahir" class="form-label">Tempat Lahir <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" id="tempat_lahir" value="{{ $user->tempat_lahir }}"
                                name="tempat_lahir" placeholder="ex: Malang" >
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                    class="mandatory">*</span></label>
                            <input type="date" class="form-control" id="tanggal_lahir"
                                value="{{ $user->tanggal_lahir }}" name="tanggal_lahir" >
                        </div>
                    </div>

                    <h5 class="card-title mt-2">Data Orang Tua</h5>
                    <div class="row g-3">
                        <div class="col-sm-12 col-md-6">
                            <label for="nama_lengkap_ayah" class="form-label">Nama Lengkap Ayah <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="nama_lengkap_ayah"
                                placeholder="ex: Budi Setyawan" value="{{ $father->nama_lengkap_ayah }}" >
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nama_lengkap_ibu" class="form-label">Nama Lengkap Ibu <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $mother->nama_lengkap_ibu }}"
                                name="nama_lengkap_ibu" placeholder="ex: Putri Tjisaka" >
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nik_ayah" class="form-label">NIK Ayah <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="nik_ayah" value="{{ $father->nik_ayah }}"
                                placeholder="ex: 213521376182367" maxlength="16" >
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nik_ibu" class="form-label">NIK Ibu <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $mother->nik_ibu }}" name="nik_ibu"
                                placeholder="ex: 123721596236" maxlength="16" >
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah <span
                                    class="mandatory">*</span></label>
                            <select class="form-select" name="pekerjaan_ayah" >
                                @foreach ($job as $item)
                                    <option value="{{ $item }}"
                                        {{ $item === $father->pekerjaan_ayah ? 'selected' : '' }}> {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu <span
                                    class="mandatory">*</span></label>
                            <select class="form-select" name="pekerjaan_ibu" >
                                @foreach ($job as $item)
                                    <option value="{{ $item }}"
                                        {{ $item === $mother->pekerjaan_ibu ? 'selected' : '' }}> {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="nama_kantor_ayah" class="form-label">Nama Kantor Ayah <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $father->nama_kantor_ayah }}"
                                name="nama_kantor_ayah" placeholder="ex: Sawah" >
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nama_kantor_ibu" class="form-label">Nama Kantor Ibu <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $mother->nama_kantor_ibu }}"
                                name="nama_kantor_ibu" placeholder="ex: Rumah" >
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah <span
                                    class="mandatory">*</span></label>
                            <select class="form-select" name="penghasilan_ayah" >
                                @foreach ($salary as $item)
                                    <option value="{{ $item }}"
                                        {{ $item === $father->penghasilan_ayah ? 'selected' : '' }}> {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu <span
                                    class="mandatory">*</span></label>
                            <select class="form-select" name="penghasilan_ibu">
                                @foreach ($salary as $item)
                                    <option value="{{ $item }}"
                                        {{ $item === $mother->penghasilan_ibu ? 'selected' : '' }}> {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="no_telp_ayah" class="form-label">No. Telp Ayah <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $father->no_telp_ayah }}"
                                name="no_telp_ayah" placeholder="ex: 08213526135" >
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="no_telp_ibu" class="form-label">No. Telp Ibu <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $mother->no_telp_ibu }}"
                                name="no_telp_ibu" placeholder="ex: 08213526135" >
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Siswa</button>
                </form>
            </div>
        </div>
    </div>
@endsection
