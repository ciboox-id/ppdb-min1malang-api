@extends('layouts.pemetaan')

@section('container')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
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

                    <div class="card overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title-table">Identitas diri</h5>

                            <div class="row">
                                <div class="col-2">
                                    <img src="{{ asset($user->foto_siswa) }}" class="img-thumbnail" alt="{{ $user->nama_lengkap }}">
                                    {{-- <img src="{{ asset('/images/profile-img.jpg') }}" class="img-thumbnail"
                                        alt="{{ $user->nama_lengkap }}"> --}}
                                </div>
                                <div class="col-5">
                                    <ul class="list-group">
                                        <li class="list-group-item">Nama Lengkap : {{ $user->nama_lengkap }}</li>
                                        <li class="list-group-item">Asal Sekolah : {{ $user->school->asal_sekolah }}</li>
                                        <li class="list-group-item">Nama Sekolah : {{ $user->school->nama_sekolah }}</li>
                                        <li class="list-group-item">Tempat Lahir : {{ $user->tempat_lahir }}</li>
                                        <li class="list-group-item">Tanggal Lahir: {{ $user->tanggal_lahir }}</li>
                                        <li class="list-group-item">Nama Ayah    : {{ $user->father->nama_lengkap_ayah }}</li>
                                    </ul>
                                </div>
                                <div class="col-5">
                                    <ul class="list-group">
                                        <li class="list-group-item">Nama Ibu     : {{ $user->mother->nama_lengkap_ibu }}</li>
                                        <li class="list-group-item">No HP Ayah   : {{ $user->father->no_telp_ayah }}</li>
                                        <li class="list-group-item">Alamat Rumah   : {{ $user->alamat_siswa }}</li>
                                        <li class="list-group-item">Kelurahan   : {{ $user->address->kelurahan }}</li>
                                        <li class="list-group-item">Kecamatan   : {{ $user->address->kecamatan }}</li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title-table">Wawancara Umum</h5>

                            <form action="{{ route('dashboard.pemetaan.umum.post', ['user' => $user->email]) }}"
                                method="post">
                                @csrf

                                <div class="d-flex flex-wrap gap-3">

                                    <div class="col-3">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No.</th>
                                                    <th colspan="3">A. Identitas</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Benar</th>
                                                    <th scope="col">Salah</th>
                                                    <th scope="col">T. Jawab</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="identitas{{ $i }}"
                                                                value="5"> 5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="identitas{{ $i }}"
                                                                value="1"> 1<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="identitas{{ $i }}"
                                                                value="0"> 0<br>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-5">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No.</th>
                                                    <th colspan="3">B. Nilai Kemandirian</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Benar</th>
                                                    <th scope="col">Salah</th>
                                                    <th scope="col">T. Jawab</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="kemandirian{{ $i }}"
                                                                value="5"> 5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="kemandirian{{ $i }}"
                                                                value="1"> 1<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="kemandirian{{ $i }}"
                                                                value="0"> 0<br>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-3">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No.</th>
                                                    <th colspan="3">C. Nilai Kognitif</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Benar</th>
                                                    <th scope="col">Salah</th>
                                                    <th scope="col">T. Jawab</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 1; $i <= 15; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="kognitif{{ $i }}"
                                                                value="10"> 10<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="kognitif{{ $i }}"
                                                                value="1"> 1<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="kognitif{{ $i }}"
                                                                value="0"> 0<br>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-3">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No.</th>
                                                    <th colspan="3">C. Nilai Numeric</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Benar</th>
                                                    <th scope="col">Salah</th>
                                                    <th scope="col">T. Jawab</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 1; $i <= 15; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="numeric{{ $i }}"
                                                                value="15"> 15<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="numeric{{ $i }}"
                                                                value="1"> 1<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="numeric{{ $i }}"
                                                                value="0"> 0<br>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-5">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No.</th>
                                                    <th colspan="6">C. Nilai Verbal</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Benar</th>
                                                    <th scope="col">S1</th>
                                                    <th scope="col">S2</th>
                                                    <th scope="col">S3</th>
                                                    <th scope="col">S4/+</th>
                                                    <th scope="col">T. Suara</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="verbal{{ $i }}"
                                                                value="15"> 15<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="verbal{{ $i }}"
                                                                value="12"> 12<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="verbal{{ $i }}"
                                                                value="8"> 8<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="verbal{{ $i }}"
                                                                value="5"> 5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="verbal{{ $i }}"
                                                                value="2"> 2<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="verbal{{ $i }}"
                                                                value="0"> 0<br>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-3">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No.</th>
                                                    <th colspan="3">C. Nilai Aktifitas</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Benar</th>
                                                    <th scope="col">Salah</th>
                                                    <th scope="col">T. Jawab</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="aktifitas{{ $i }}"
                                                                value="5"> 5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="aktifitas{{ $i }}"
                                                                value="1"> 1<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="aktifitas{{ $i }}"
                                                                value="0"> 0<br>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="d-grid mt-3">
                                    <button type="submit" class="btn  btn-block btn-primary">Nilai Wawancara
                                        Umum</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
