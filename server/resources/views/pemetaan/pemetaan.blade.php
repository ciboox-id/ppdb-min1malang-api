@extends('layouts.main')

@section('container')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title-table">Pemetaan</h5>

                            <form action="{{ route('dashboard.pemetaan.create', ['user' => $user]) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Nilai Pemetaan</button>
                                </div>

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
                                                @for ($i = 1; $i <= 5; $i++)
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
                                                @for ($i = 1; $i <= 12; $i++)
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
                                                @for ($i = 1; $i <= 12; $i++)
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
                                                @for ($i = 1; $i <= 8; $i++)
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
                                                @for ($i = 1; $i <= 8; $i++)
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

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
