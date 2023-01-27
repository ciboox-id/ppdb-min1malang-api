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
                    <a href="/data-profile" class="back btn btn-primary me-3"> Kembali</a>
                    @if ($user->is_verif)
                        <form action="{{ route('inverifikasi', ['user' => $user->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="back btn btn-danger" data-bs-target="#staticBackdrop">
                                Batal Verifikasi
                            </button>
                        </form>
                    @else
                        <button type="button" class="back btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Verifikasi data
                        </button>
                    @endif
                    <form action="{{ route('dashboard.password-reset', ['user' => $user->id]) }}" method="post" class="ms-3">
                        @csrf
                        <button type="submit" class="back btn btn-info">
                            Reset Password
                        </button>
                    </form>

                </div>

                <h5 class="card-title">Identitas diri</h5>
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
                        <label for="inputAddress" class="form-label">Golongan Darah</label>
                        <input type="text" class="form-control" id="inputAddress" value="{{ $user->golongan_darah }} "
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

                <h5 class="card-title">Data Berkas</h5>
                <div class="col-sm-12 col-md-6">
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
                <div class="col-sm-12 col-md-6">
                    <p>Foto Kartu Keluarga</p>
                    @if (!empty($user->foto_akte))
                        <a href="{{ asset($user->foto_akte) }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset($user->foto_akte) }}" alt="foto_siswa" class="foto_siswa">
                        </a>
                    @else
                        <div class="no-image">
                            <p>Belum upload foto Kartu Keluarga</p>
                        </div>
                    @endif
                </div>


                <h5 class="card-title">Data Orang Tua</h5>
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
                        <label for="inputAddress" class="form-label">Pekerjeaan Ayah</label>
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
                </form>

                <h5 class="card-title">Data Rumah</h5>
                <form class="row g-3">
                    <div class="col-sm-12 col-md-6">
                        <label for="inputNanme4" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="inputNanme4"
                            value="{{ $user->father->nama_lengkap_ayah }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputEmail4" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" value="{{ $user->mother->nama_lengkap_ibu }}"
                            disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputPassword4" class="form-label">Nomor KK</label>
                        <input type="text" class="form-control" value="{{ $user->father->nik_ayah }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Telepon Rumah</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->nik_ibu }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->father->pekerjaan_ayah }} " disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->pekerjaan_ibu }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->father->nama_kantor_ayah }}" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="inputAddress" class="form-label">Kota / Kabupaten</label>
                        <input type="text" class="form-control" id="inputAddress"
                            value="{{ $user->mother->nama_kantor_ibu }}" disabled>
                    </div>
                </form>

                <h5 class="card-title">Data Rumah</h5>
                <div class=" overflow-auto">
                    <table class="table table-borderless datatable mt-4">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
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
                                    <td class="d-flex">
                                        <a href="{{ asset($pres->sertifikat) }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="bi bi-eye-fill"></i>
                                            Lihat foto
                                        </a>
                                    </td>
                                    <td>
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

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                            <input type="date" name="pemetaan_date" id="" class="form-control" required>
                        </div>
                        <div>
                            <label for="">Jam</label>
                            <input type="time" name="pemetaan_time" id="" class="form-control" required>
                        </div>
                        <div>
                            <label for="">Nama Verifikator</label>
                            <input type="text" name="name_validator" id="" class="form-control" required>
                        </div>
                        <div class=" d-grid">
                            <button type="submit" class="btn btn-primary btn-block">Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
