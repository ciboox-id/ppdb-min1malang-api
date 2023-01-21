@extends('layouts.main')

@section('container')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="/data-profile">Kembali</a>
                <h5 class="card-title">Identitas diri</h5>

                <form class="row g-3">
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="inputNanme4" value="{{ $user->nama_lengkap }}"
                            disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label">Anak ke</label>
                        <input type="text" class="form-control" value="{{ $user->anak_ke }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputPassword4" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="{{ $user->jenis_kelamin }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">NISN</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->nisn }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Golongan Darah</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->golongan_darah }} "
                            disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Asal Sekolah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->school->asal_sekolah }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->tempat_lahir }}"
                            disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->school->nama_sekolah }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->tanggal_lahir }}"
                            disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">NPSN</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->school->npsn }}"
                            disabled>
                    </div>
                </form>

                <h5 class="card-title">Data Berkas</h5>
                <div class="d-flex">
                    <div class="col-6">
                        <p>Foto Siswa</p>
                        <img src="{{ asset($user->foto_siswa) }}" alt="foto_siswa">
                    </div>
                    <div class="col-6">
                        <p>Foto Kartu Keluarga</p>
                        <img src="{{ asset($user->foto_akte) }}" alt="foto_akte">
                    </div>
                </div>


                <h5 class="card-title">Data Orang Tua</h5>
                <form class="row g-3">
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Nama Lengkap Ayah</label>
                        <input type="text" class="form-control" id="inputNanme4"
                            value="{{ $user->father->nama_lengkap_ayah }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label">Nama Lengkap Ibu</label>
                        <input type="text" class="form-control" value="{{ $user->mother->nama_lengkap_ibu }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputPassword4" class="form-label">NIK Ayah</label>
                        <input type="text" class="form-control" value="{{ $user->father->nik_ayah }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">NIK Ibu</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->nik_ibu }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Pekerjeaan Ayah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->father->pekerjaan_ayah }} " disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Pekerjaan Ibu</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->pekerjaan_ibu }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Nama Kantor Ayah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->father->nama_kantor_ayah }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Nama Kantor Ibu</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->nama_kantor_ibu }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Penghasilan Ayah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->father->penghasilan_ayah }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Penghasilan Ibu</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->penghasilan_ibu }}" disabled>
                    </div>
                </form>

                <h5 class="card-title">Data Rumah</h5>
                <form class="row g-3">
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="inputNanme4"
                            value="{{ $user->father->nama_lengkap_ayah }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" value="{{ $user->mother->nama_lengkap_ibu }}"
                            disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputPassword4" class="form-label">Nomor KK</label>
                        <input type="text" class="form-control" value="{{ $user->father->nik_ayah }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Telepon Rumah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->nik_ibu }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->father->pekerjaan_ayah }} " disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->pekerjaan_ibu }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->father->nama_kantor_ayah }}" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Kota / Kabupaten</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->nama_kantor_ibu }}" disabled>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection