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

                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title-table">Wawancara Agama</h5>

                            <form id="formAgama" action="{{ route('dashboard.pemetaan.agama.post', ['user' => $user->email]) }}"
                                method="post">
                                @csrf

                                <div class="d-flex flex-wrap gap-3">

                                    <div class="col-5">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No.</th>
                                                    <th colspan="6">G. Hafalan Doa Harian</th>
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
                                                @for ($i = 1; $i <= 17; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
                                                                value="10"> 10<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
                                                                value="8"> 8<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
                                                                value="5"> 5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
                                                                value="3"> 3<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
                                                                value="1"> 1<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
                                                                value="0"> 0<br>
                                                        </td>
                                                    </tr>
                                                @endfor
                                                @for ($i = 18; $i <= 20; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
                                                                value="15"> 15<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
                                                                value="10"> 10<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
                                                                value="7"> 7<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
                                                                value="5"> 5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
                                                                value="2"> 2<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="doa{{ $i }}" class="form-check-input"
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
                                                    <th colspan="6">H. Hafalan Surat Pendek</th>
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
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
                                                                value="10"> 10<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
                                                                value="8"> 8<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
                                                                value="5"> 5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
                                                                value="3"> 3<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
                                                                value="1"> 1<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
                                                                value="0"> 0<br>
                                                        </td>
                                                    </tr>
                                                @endfor
                                                @for ($i = 11; $i <= 20; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
                                                                value="15"> 15<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
                                                                value="10"> 10<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
                                                                value="7"> 7<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
                                                                value="5"> 5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
                                                                value="2"> 2<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="surat{{ $i }}" class="form-check-input"
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
                                                    <th colspan="6">I. Hafalan Bacaan Solat</th>
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
                                                @php
                                                    $values = [[15, 10, 7, 5, 3, 0], [5, 4, 3, 2, 1, 0], [20, 15, 10, 7, 5, 0], [10, 7, 5, 4, 2, 0], [15, 10, 7, 5, 3, 0], [10, 7, 5, 4, 2, 0], [15, 10, 7, 5, 3, 0], [15, 10, 7, 5, 3, 0], [20, 15, 10, 7, 5, 0], [5, 4, 3, 2, 1, 0]];
                                                @endphp

                                                @for ($i = 0; $i < count($values); $i++)
                                                    <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        @for ($j = 0; $j < count($values[$i]); $j++)
                                                            <td>
                                                                <input type="radio" name="solat{{ $i + 1 }}[]" class="form-check-input"
                                                                    value="{{ $values[$i][$j] }}">
                                                                {{ $values[$i][$j] }}
                                                            </td>
                                                        @endfor
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
                                                    <th colspan="6">J. Nilai Mengaji</th>
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
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="15"> 15<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="12"> 12<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="9"> 9<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="7"> 7<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="5"> 5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="0"> 0<br>
                                                        </td>
                                                    </tr>
                                                @endfor
                                                @for ($i = 11; $i <= 15; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="10"> 10<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="8"> 8<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="6"> 6<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="5"> 5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="3"> 3<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="0"> 0<br>
                                                        </td>
                                                    </tr>
                                                @endfor
                                                @for ($i = 16; $i <= 20; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="10"> 10<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="8"> 8<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="6"> 6<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="5"> 5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="mengaji{{ $i }}"
                                                                class="form-check-input" value="3"> 3<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="solat{{ $i }}"
                                                                class="form-check-input" value="0"> 0<br>
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
                                                    <th colspan="6">K. Nilai Mengaji Lanjutan</th>
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
                                                @for ($i = 21; $i <= 28; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i }}
                                                        </td>
                                                        <td>
                                                            <input type="radio"
                                                                name="mengaji_lanjut{{ $i }}" value="5"
                                                                class="form-check-input">
                                                            5<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio"
                                                                name="mengaji_lanjut{{ $i }}" value="4"
                                                                class="form-check-input">
                                                            4<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio"
                                                                name="mengaji_lanjut{{ $i }}" value="3"
                                                                class="form-check-input">
                                                            3<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio"
                                                                name="mengaji_lanjut{{ $i }}" value="2"
                                                                class="form-check-input">
                                                            2<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio"
                                                                name="mengaji_lanjut{{ $i }}" value="1"
                                                                class="form-check-input">
                                                            1<br>
                                                        </td>
                                                        <td>
                                                            <input type="radio"
                                                                name="mengaji_lanjut{{ $i }}" value="0"
                                                                class="form-check-input">
                                                            0<br>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="d-grid mt-3">
                                    <button type="submit" class="btn  btn-block btn-primary">Nilai Wawancara
                                        Agama</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var form = document.getElementById('formAgama');

        // Save form data to local storage when a change is made
        form.addEventListener('change', function() {
            localStorage.setItem('formAgama', JSON.stringify(Array.from(new FormData(form))));
        });

        // Clear form data from local storage when the form is submitted
        form.addEventListener('submit', function() {
            localStorage.removeItem('formAgama');
        });

        window.addEventListener('load', function() {
        var formData = localStorage.getItem('formAgama');
        if (formData) {
            formData = JSON.parse(formData);
            formData.forEach(function(field) {
                var input = form.elements[field[0]];
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = (field[1] === input.value);
                } else {
                    input.value = field[1];
                }
            });
        }
    });
    </script>
@endsection
