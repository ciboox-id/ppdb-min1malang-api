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
                <div class="d-flex">
                    <a href="{{ route('dashboard.admin') }}" class="back btn btn-primary me-3">Kembali</a>

                    @if ($user->is_verif)
                        <form action="{{ route('inverifikasi', ['user' => $user->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="back btn btn-danger" data-bs-target="#staticBackdrop">
                                Batal Verifikasi
                            </button>
                        </form>
                    @else
                        <a href="{{ route('dashboard.verifikasi', ['user' => $user->email]) }}"
                            class="back btn btn-info">Verifikasi</a>
                    @endif

                    <form action="{{ route('dashboard.password-reset', ['user' => $user->id]) }}" method="post"
                        class="ms-3">
                        @csrf
                        <button type="submit" class="back btn btn-warning me-3">
                            Reset Password
                        </button>
                    </form>
                    <a href="{{ route('dashboard.data-siswa.edit', ['user' => $user->email]) }}"
                        class="back btn btn-secondary">Edit Profile</a>
                </div>
                <h5 class="card-title mt-2">Identitas diri</h5>
                <form class="row g-3">
                    <div class="col-sm-12 col-md-6">
                        <label for="inputNanme4" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="inputNanme4" value="{{ $user->nama_lengkap }}"
                            disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="nama_panggilan" class="form-label">Nama Panggilan </label>
                        <input type="text" class="form-control" name="nama_panggilan" value="{{ $user->nama_panggilan }}"
                            disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="email_siswa" class="form-label">Email siswa untuk pembelajaran</label>
                        <input type="text" class="form-control" name="email_siswa" value="{{ $user->email_siswa }}"
                            disabled>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="jumlah_saudara" class="form-label">Jumlah Saudara Kandung </label>
                        <input type="number" class="form-control" value="{{ $user->jumlah_saudara }}"
                            name="jumlah_saudara" disabled>
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

                    <div class="col-sm-12 col-md-6">
                        <label for="hobi" class="form-label">Hobi </label>
                        <input type="text" class="form-control" value="{{ $user->hobi }}" name="hobi" disabled>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="cita" class="form-label">Cita - cita</label>
                        <input type="text" class="form-control" value="{{ $user->cita }}" name="cita" disabled>
                    </div>
                </form>

                <h5 class="card-title mt-2">Data Berkas</h5>
                <table class="table table-bordered datatable">
                    <thead class="table-success">
                        <tr>
                            <th>No.</th>
                            <th>Jenis berkas</th>
                            <th>Nama File</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1.</td>
                            <td>Foto Siswa</td>
                            <td>{{ basename($user->foto_siswa) ?? '-' }}</td>
                            <td>
                                @if (!empty($user->foto_siswa))
                                    <a href="{{ asset($user->foto_siswa) }}" target="_blank" rel="noopener noreferrer">
                                        <p>Lihat foto</p>
                                    </a>
                                @else
                                    <div class="no-image">
                                        <p>Belum upload foto diri</p>
                                    </div>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>2.</td>
                            <td>Foto Kartu Keluarga</td>
                            <td>{{ basename($user->foto_kk) ?? '-' }}</td>
                            <td>
                                @if (!empty($user->foto_kk))
                                    <a href="{{ asset($user->foto_kk) }}" target="_blank" rel="noopener noreferrer">
                                        <p>Lihat foto</p>
                                    </a>
                                @else
                                    <div class="no-image">
                                        <p>Belum upload Berkas Kartu Keluarga</p>
                                    </div>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>3.</td>
                            <td>Foto Akte kelahiran</td>
                            <td>{{ basename($user->foto_akte) ?? '-' }}</td>
                            <td>
                                @if (!empty($user->foto_akte))
                                    <a href="{{ asset($user->foto_akte) }}" target="_blank" rel="noopener noreferrer">
                                        <p>Lihat foto</p>
                                    </a>
                                @else
                                    <div class="no-image">
                                        <p>Belum upload Berkas akte kelahiran</p>
                                    </div>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>4.</td>
                            <td>Foto Surat Keterangan TK</td>
                            <td>{{ basename($user->foto_ket_tk) ?? '-' }}</td>
                            <td>
                                @if (!empty($user->foto_ket_tk))
                                    <a href="{{ asset($user->foto_ket_tk) }}" target="_blank" rel="noopener noreferrer">
                                        <p>Lihat foto</p>
                                    </a>
                                @else
                                    <div class="no-image">
                                        <p>Belum upload Berkas Keterangan TK</p>
                                    </div>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>5.</td>
                            <td>Foto Surat Psikolog</td>
                            <td>{{ basename($user->foto_psikolog) ?? '-' }}</td>
                            <td>
                                @if (!empty($user->foto_psikolog))
                                    <a href="{{ asset($user->foto_psikolog) }}" target="_blank"
                                        rel="noopener noreferrer">
                                        <p>Lihat foto</p>
                                    </a>
                                @else
                                    <div class="no-image">
                                        <p>Belum upload Berkas psikolog umur < 6 thn</p>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="card-title mt-2">Data Orang Tua</h5>
                <form class="row g-3">
                    <h6 class="card-subtitle mt-3 mb-0"><mark>Data Ayah</mark></h6>
                    <div class="col-sm-12 col-md-6">
                        <label for="gelar_depan_ayah" class="form-label">Gelar Depan</label>
                        <input type="text" class="form-control" name="gelar_depan_ayah"
                            value="{{ $father->gelar_depan }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="nama_lengkap_ayah" class="form-label">Nama Lengkap Ayah</label>
                        <input type="text" class="form-control" name="nama_lengkap_ayah"
                            value="{{ $father->nama_lengkap_ayah }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="gelar_belakang_ayah" class="form-label">Gelar belakang</label>
                        <input type="text" class="form-control" name="gelar_belakang_ayah"
                            value="{{ $father->gelar_belakang }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="nik_ayah" class="form-label">NIK Ayah </label>
                        <input type="text" class="form-control" name="nik_ayah" value="{{ $father->nik_ayah }}"
                            maxlength="16" disabled>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                        <input type="text" class="form-control" name="nik_ayah"
                            value="{{ $father->pekerjaan_ayah }}" disabled>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="nama_kantor_ayah" class="form-label">Nama Kantor Ayah</label>
                        <input type="text" class="form-control" value="{{ $father->nama_kantor_ayah }}"
                            name="nama_kantor_ayah" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah</label>
                        <input type="text" class="form-control" value="{{ $father->penghasilan_ayah }}"
                            name="nama_kantor_ayah" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="no_telp_ayah" class="form-label">No. Telp Ayah</label>
                        <input type="text" class="form-control" value="{{ $father->no_telp_ayah }}"
                            name="no_telp_ayah" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="status_ayah" class="form-label">Status ayah </label>
                        <input type="text" class="form-control" value="{{ $father->status }}" name="status_ayah"
                            disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="tempat_lahir_ayah" class="form-label">Tempat Lahir Ayah</label>
                        <input type="text" class="form-control" value="{{ $father->tempat_lahir }}"
                            name="tempat_lahir_ayah" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="tanggal_lahir_ayah" class="form-label">Tanggal Lahir Ayah</label>
                        <input type="date" class="form-control" value="{{ $father->tanggal_lahir }}"
                            name="tanggal_lahir_ayah" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="pend_terakhir_ayah" class="form-label">Pendidikan terakhir</label>
                        <input type="text" class="form-control" value="{{ $father->pend_terakhir }}"
                            name="tanggal_lahir_ayah" disabled>
                    </div>


                    <h6 class="card-subtitle mt-3 mb-0"><mark>Data Ibu</mark></h6>
                    <div class="col-sm-12 col-md-6">
                        <label for="gelar_depan_ibu" class="form-label">Gelar Depan</label>
                        <input type="text" class="form-control" name="gelar_depan_ibu"
                            value="{{ $mother->gelar_depan }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="nama_lengkap_ibu" class="form-label">Nama Lengkap Ibu</label>
                        <input type="text" class="form-control" name="nama_lengkap_ibu"
                            value="{{ $mother->nama_lengkap_ibu }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="gelar_belakang_ibu" class="form-label">Gelar belakang</label>
                        <input type="text" class="form-control" name="gelar_belakang_ibu"
                            value="{{ $mother->gelar_belakang }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="nik_ibu" class="form-label">NIK Ibu </label>
                        <input type="text" class="form-control" value="{{ $mother->nik_ibu }}" name="nik_ibu"
                            maxlength="16" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                        <input type="text" class="form-control" value="{{ $mother->pekerjaan_ibu }}"
                            name="tanggal_lahir_ayah" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="nama_kantor_ibu" class="form-label">Nama Kantor Ibu</label>
                        <input type="text" class="form-control" value="{{ $mother->nama_kantor_ibu }}"
                            name="nama_kantor_ibu" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu</label>
                        <input type="text" class="form-control" value="{{ $mother->penghasilan_ibu }}"
                            name="tanggal_lahir_ayah" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="no_telp_ibu" class="form-label">No. Telp Ibu </label>
                        <input type="text" class="form-control" value="{{ $mother->no_telp_ibu }}"
                            name="no_telp_ibu" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="status_ibu" class="form-label">Status Ibu </label>
                        <input type="text" class="form-control" value="{{ $mother->status }}" name="status_ibu"
                            disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="tempat_lahir_ibu" class="form-label">Tempat Lahir Ibu</label>
                        <input type="text" class="form-control" value="{{ $mother->tempat_lahir }}"
                            name="tempat_lahir_ibu" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="tanggal_lahir_ibu" class="form-label">Tanggal Lahir Ibu</label>
                        <input type="date" class="form-control" value="{{ $mother->tanggal_lahir }}"
                            name="tanggal_lahir_ibu" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="pend_terakhir_ibu" class="form-label">Pendidikan terakhir</label>
                        <input type="text" class="form-control" value="{{ $mother->pend_terakhir }}"
                            name="tanggal_lahir_ibu" disabled>
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
                </form>

                <h5 class="card-title">Upload Berkas</h5>
                <div class=" overflow-auto">
                    <table class="table table-bordered datatable mt-4">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tingkat</th>
                                <th scope="col">Valid</th>
                                <th scope="col">Verifikator</th>
                                <th scope="col">Sertifikat</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->prestasi as $pres)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $pres->prestasi }}</td>
                                    <td>{{ $pres->tingkat }}</td>
                                    <td>
                                        @if ($pres->is_valid)
                                            <p>Valid</p>
                                        @endif
                                    </td>
                                    <td>{{ $pres->name_validator }}</td>
                                    <td class="d-flex">
                                        <a href="{{ asset($pres->sertifikat) }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="bi bi-eye-fill"></i>
                                            Lihat foto
                                        </a>
                                    </td>
                                    <td>
                                        <div>
                                            <div>
                                                <a href="{{ route('dashboard.verifikasi.sertifikat', ['prestasi' => $pres->id]) }}"
                                                    target="_blank" rel="noopener noreferrer"
                                                    class="badge rounded-pill bg-success btn-aksi">
                                                    Verifikasi
                                                </a>
                                            </div>
                                        </div>
                                        <div>
                                            {{-- <form
                                                action="{{ route('dashboard.data-prestasi.delete', ['id' => $pres->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="badge rounded-pill bg-danger">
                                                    <i class="bi bi-trash"></i>
                                                    Hapus
                                                </button>
                                            </form> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    {{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pemetaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('verifikasi', ['user' => $user->id]) }}" method="POST" class="row g-3">
                        @csrf
                        <div>
                            <label for="">Tanggal</label>
                            <select class="form-select" name="pemetaan_date">
                                @foreach ($date as $dt)
                                    <option value="{{ $dt }}"> {{ $dt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="">Jam</label>
                            <select class="form-select" name="pemetaan_time">
                                @foreach ($time as $tm)
                                    <option value="{{ $tm }}"> {{ $tm }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="">Nama Verifikator</label>
                            <select class="form-select" name="name_validator">
                                @foreach ($verifikator as $verif)
                                    <option value="{{ $verif->nama_lengkap }}"> {{ $verif->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" d-grid">
                            <button type="submit" class="btn btn-primary btn-block">Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
