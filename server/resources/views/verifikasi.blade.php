@extends('layouts.main')

@section('container')
    <div class="col-12 d-flex">

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

        <div class="card col-8 me-3 overflow-auto">
            <div class="card-body verif-data">
                <div class="d-flex col-12">
                    <a href="{{ route('dashboard.admin') }}" class="back btn btn-primary me-3">Kembali</a>
                </div>

                <h5 class="card-title mt-2">Identitas diri</h5>
                <form class="row g-3">
                    <div class="col-sm-12 col-md-6">
                        <label for="inputNanme4" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="inputNanme4" value="{{ $user->nama_lengkap }}"
                            disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputEmail4" class="form-label">Anak ke</label>
                        <input type="text" class="form-control" value="{{ $user->anak_ke }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputPassword4" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="{{ $user->jenis_kelamin }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">NISN</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->nisn }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->nik }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Golongan Darah</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->gol_darah }} "
                            disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Asal Sekolah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->school->asal_sekolah }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->tempat_lahir }}"
                            disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->school->nama_sekolah }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->tanggal_lahir }}"
                            disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">NPSN</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->school->npsn }}"
                            disabled>
                    </div>
                </form>

                <h5 class="card-title mt-2">Data Berkas</h5>
                <div class="foto-berkas">
                    <div class="col-sm-12 col-md-6 mt-2">
                        <p>Foto Siswa</p>
                        @if (!empty($user->foto_siswa))
                            <a href="{{ asset($user->foto_siswa) }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset($user->foto_siswa) }}" alt="foto_siswa" class="foto_siswa">
                            </a>
                        @else
                            <div class="no-image">
                                <p>Belum upload foto diri</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-6 mt-2">
                        <p>Berkas Kartu Keluarga</p>
                        @if (!empty($user->foto_akte))
                            <a href="{{ asset($user->foto_kk) }}" target="_blank" rel="noopener noreferrer">
                                <p>Lihat Berkas kartu keluarga</p>
                            </a>
                        @else
                            <div class="no-image">
                                <p>Belum upload Berkas Kartu Keluarga</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-6 mt-2">
                        <p>Berkas Keterangan TK</p>
                        @if (!empty($user->foto_ket_tk))
                            <a href="{{ asset($user->foto_ket_tk) }}" target="_blank" rel="noopener noreferrer">
                                <p>Lihat Berkas Keterangan TK</p>
                            </a>
                        @else
                            <div class="no-image">
                                <p>Belum upload Berkas Keterangan TK</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-6 mt-2">
                        <p>Berkas Akte kelahiran</p>
                        @if (!empty($user->foto_akte))
                            <a href="{{ asset($user->foto_akte) }}" target="_blank" rel="noopener noreferrer">
                                <p>Lihat Berkas Akte Kelahiran</p>
                            </a>
                        @else
                            <div class="no-image">
                                <p>Belum upload Berkas akte kelahiran</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-6 mt-2">
                        <p>Berkas Psikolog anak umur < 6 thn</p>
                        @if (!empty($user->foto_psikolog))
                            <a href="{{ asset($user->foto_psikolog) }}" target="_blank"
                                rel="noopener noreferrer">
                                <p>Lihat Berkas Psikolog</p>
                            </a>
                        @else
                            <div class="no-image">
                                <p>Belum upload Berkas psikolog umur < 6 thn</p>
                            </div>
                        @endif
                    </div>
                </div>

                <h5 class="card-title mt-2">Data Orang Tua</h5>
                <form class="row g-3">
                    <div class="col-sm-12 col-md-6">
                        <label for="inputNanme4" class="form-label">Nama Lengkap Ayah</label>
                        <input type="text" class="form-control" id="inputNanme4"
                            value="{{ $user->father->nama_lengkap_ayah }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputEmail4" class="form-label">Nama Lengkap Ibu</label>
                        <input type="text" class="form-control" value="{{ $user->mother->nama_lengkap_ibu }}"
                            disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputPassword4" class="form-label">NIK Ayah</label>
                        <input type="text" class="form-control" value="{{ $user->father->nik_ayah }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">NIK Ibu</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->nik_ibu }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Pekerjaan Ayah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->father->pekerjaan_ayah }} " disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Pekerjaan Ibu</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->pekerjaan_ibu }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Nama Kantor Ayah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->father->nama_kantor_ayah }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Nama Kantor Ibu</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->nama_kantor_ibu }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Penghasilan Ayah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->father->penghasilan_ayah }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Penghasilan Ibu</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->penghasilan_ibu }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">No. Telp Ayah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->father->no_telp_ayah }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">No. Telp Ibu</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->no_telp_ibu }}" disabled>
                    </div>
                </form>

                <h5 class="card-title mt-2">Data Rumah</h5>
                <form class="row g-3">
                    <div class="col-sm-12 col-md-6">
                        <label for="inputNanme4" class="form-label">Alamat Siswa</label>
                        <input type="text" class="form-control" id="inputNanme4" value="{{ $user->alamat_siswa }}"
                            disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputEmail4" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" value="{{ $user->address->kode_pos }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputPassword4" class="form-label">Nomor KK</label>
                        <input type="text" class="form-control" value="{{ $user->address->no_kk }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->address->kelurahan }} " disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->address->kecamatan }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Kota / Kabupaten</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->address->kota_kab }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Jarak rumah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->address->jarak_rumah }}" disabled>
                    </div>

                    <div class=" overflow-auto">
                        <h5 class="card-title mt-2">Data Rumah</h5>
                        <table class="table table-bordered datatable mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Sertifikat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->prestasi as $pres)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $pres->prestasi }}</td>
                                        <td class="d-flex">
                                            <a href="{{ asset($pres->sertifikat) }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="bi bi-eye-fill"></i>
                                                Lihat foto
                                            </a>
                                        </td>
                                        <td>
                                            @if ($pres->is_valid)
                                               <p>Valid</p>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{ route('dashboard.verifikasi.sertifikat', ['prestasi' => $pres->id]) }}"
                                                    target="_blank" rel="noopener noreferrer"
                                                    class="badge rounded-pill bg-success btn-aksi">
                                                    Verifikasi
                                                </a>
                                            </div>
                                            <div>
                                                <form
                                                    action="{{ route('dashboard.data-prestasi.delete', ['id' => $pres->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="badge rounded-pill bg-danger">
                                                        <i class="bi bi-trash"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>

        <div class="card col-4 ">
            <div class="card-body verif-act">
                <p class="card-title mt-3">Verifikasi Calon Siswa</p>
                <form action="{{ route('verifikasi', ['user' => $user->id]) }}" method="post">
                    @csrf

                    <h5>Upload Berkas</h3>
                        <div class="verif-container">
                            <div>
                                <p>Foto Akte</p>
                                @if ($user->foto_akte != null)
                                    <a href="{{ $user->foto_akte }}" target="_blank" rel="noopener noreferrer">Ada</a>
                                @else
                                    <p>Tidak Ada</p>
                                @endif
                            </div>

                            <div>
                                <p>Foto Kartu Keluarga</p>
                                @if ($user->foto_kk != null)
                                    <a href="{{ $user->foto_kk }}" target="_blank" rel="noopener noreferrer">Ada</a>
                                @else
                                    <p>Tidak Ada</p>
                                @endif
                            </div>

                            <div>
                                <p>Foto Surat Keterangan TK</p>
                                @if ($user->foto_ket_tk != null)
                                    <a href="{{ $user->foto_ket_tk }}" target="_blank" rel="noopener noreferrer">Ada</a>
                                @else
                                    <p>Tidak Ada</p>
                                @endif
                            </div>

                            <div>
                                <p>Foto Siswa</p>
                                @if ($user->foto_siswa != null)
                                    <a href="{{ $user->foto_siswa }}" target="_blank" rel="noopener noreferrer">Ada</a>
                                @else
                                    <p>Tidak Ada</p>
                                @endif
                            </div>

                            <div>
                                <p>Piagam Juara</p>
                                <div class="form-check">
                                    <input type="radio" id="piagam_juara" name="piagam_juara" value="yes"
                                        class="form-check-input">
                                    <label for="piagam_juara">Ada</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="piagam_juara_no" name="piagam_juara" value="no"
                                        class="form-check-input">
                                    <label for="piagam_juara_no">Tidak Ada</label>
                                </div>
                            </div>

                            <div>
                                <p>Sertifikat Tahfidz</p>
                                <div class="form-check">
                                    <input type="radio" id="sertifikat_tahfidz" name="sertifikat_tahfidz"
                                        value="yes" class="form-check-input">
                                    <label for="sertifikat_tahfidz">Ada</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="sertifikat_tahfidz_no" name="sertifikat_tahfidz"
                                        value="no" class="form-check-input">
                                    <label for="sertifikat_tahfidz_no">Tidak Ada</label>
                                </div>
                            </div>

                            <div>
                                <p>Surat Keterangan Yatim</p>
                                <div class="form-check">
                                    <input type="radio" id="surat_ket_yatim" name="surat_ket_yatim" value="yes"
                                        class="form-check-input">
                                    <label for="surat_ket_yatim">Ada</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="surat_ket_yatim_no" name="surat_ket_yatim" value="no"
                                        class="form-check-input">
                                    <label for="surat_ket_yatim_no">Tidak Ada</label>
                                </div>
                            </div>

                            <div>
                                <p>NISN</p>
                                @if ($user->nisn != null)
                                    <span>Ada</span>
                                @else
                                    <span>Tidak Ada</span>
                                @endif
                            </div>

                            <div>
                                <p>Surat Psikolog</p>
                                @if ($user->foto_psikolog != null)
                                    <a href="{{ $user->foto_psikolog }}" target="_blank"
                                        rel="noopener noreferrer">Ada</a>
                                @else
                                    <span>Tidak Ada</span>
                                @endif
                            </div>
                        </div>


                        <h5 class="mt-4">Verifikator</h5>
                        <div class="verif-container">
                            <div>
                                <p>Nama verifikator</p>
                                <span>{{ auth()->user()->nama_lengkap }}</span>
                            </div>
                        </div>

                        <h5 class="mt-4">Catatan :</h5>
                        <div class="verif-container">
                            <textarea name="pesan" id="" cols="100" rows="10" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-aksi mt-4" disabled>Verifikasi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
