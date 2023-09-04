<!DOCTYPE html>
<html>

<head>
    <title>Verval PPDB</title>
    <style type="text/css">
        * {
            font-family: 'Arial';
        }

        table {
            border-width: 3px;
        }

        table tr .text2 {
            text-align: right;
            font-size: 13px;
        }

        .left {
            text-align: left;
        }

        table tr .text {
            text-align: center;
            font-size: 13px;
        }

        table tr td {
            font-size: 13px;
        }

        .table-col tr th {
            font-size: 14px;
            /* text-align: center; */
        }

        .table-col tr td {
            text-align: center;
        }

        .bordering tr td {
            border: solid 1px #000;
            text-align: start;
            padding: 5px 10px;
        }

        .bordering tr th {
            border: solid 1px #000;
            text-align: start;
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <center>
        <table width="530">
            <tr>
                <td><img src="{{ public_path('images/logo-icon.png') }}" width="90" height="90"></td>
                <td>
                    <center>
                        <font size="5">KEMENTRIAN AGAMA REPUBLIK INDONESIA</font><br>
                        <font size="4">KANTOR KEMENTRIAN AGAMA KOTA MALANG</font><br>
                        <font size="3">MADRASAH IBTIDAIYAH NEGERI 1 KOTA MALANG</font><br>
                        <font size="2">Jl. Bandung 7C Malang, Telp 0341-551176, Fax 0341-565642</font>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <table width="525">
                <tr>
                    <td class="text2">Malang, 11/02/2023</td>
                </tr>
            </table>
        </table>
        <table>
            <tr class="text2">
                <td>Nomer</td>
                <td width="572">: B-83/mi.13.25.1/2/PP.00.55/02/2023</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td width="564">: Segara</td>
            </tr>
            <tr>
                <td>Lamp</td>
                <td width="564">: -</td>
            </tr>
            <tr>
                <td>Hal.</td>
                <td width="564">: Hasil Verifikasi dan Validasi PPDB</td>
            </tr>
        </table>
        <br>
        <table width="530">
            <tr>
                <td>
                    <font size="2">Kepada: <br>Yth Peserta PPDB MIN 1 Kota Malang<br>Di tempat</font>
                </td>
            </tr>
        </table>
        <br>
        </table>
        <table width="480">
            <tr>
                <td style="text-align: center; font-size: 15px;">HASIL SELEKSI ADMINISTRASI PPDB MIN 1 KOTA MALANG</td>
            </tr>
        </table>
        <br>
        <table width="530" style="padding: 5px 30px;">
            <tr>
                <td style="width: 100px">No. Pemetaan</td>
                <td>: {{ $pemetaan->id }}</td>
            </tr>
            <tr>
                <td style="width: 100px">Nama Lengkap</td>
                <td>: {{ $user->nama_lengkap }}</td>
            </tr>
            <tr>
                <td style="width: 100px">NISN Siswa</td>
                <td>: {{ $user->nisn }}</td>
            </tr>
            <tr>
                <td style="width: 100px">Jenis Kelamin</td>
                <td style="text-transform: uppercase;" width="450">: {{ $user->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td style="width: 100px">Tmpt/Tgl Lahir</td>
                <td width="450">: {{ $user->tempat_lahir }}, {{ $user->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td style="width: 100px">Alamat</td>
                <td style="text-transform: uppercase;">: {{ $user->alamat_siswa }}</td>
            </tr>
            <tr>
                <td style="width: 100px">No. Telepon</td>
                <td>: {{ $user->mother->no_telp_ibu }}</td>
            </tr>
            <tr>
                <td style="width: 100px">Nama Ayah</td>
                <td style="text-transform: uppercase;">: {{ $user->father->nama_lengkap_ayah }}</td>
            </tr>
            <tr>
                <td style="width: 100px">Nama Ibu</td>
                <td style="text-transform: uppercase;">: {{ $user->mother->nama_lengkap_ibu }}</td>
            </tr>
        </table>
        <br>
        <table width="530">
            <tr>
                <td>Berkas anda sudah kami verifikasi dan hasilnya : LOLOS</td>
            </tr>
        </table>
        <br>
        <table width="500" class="table-col" style="border: 1px solid #000; border-collapse: collapse"
            class="bordering">
            <tr style="border: 1px solid #000">
                <th>Uraian</th>
                <th>Fc. Akte</th>
                <th>Foto</th>
                <th>Fc. KK</th>
                <th>Surat Keterangan TK</th>
            </tr>
            <tr style="border: 1px solid #000">
                <td>Berkas</td>
                <td>Ada</td>
                <td>Ada</td>
                <td>Ada</td>
                <td>Ada</td>
            </tr>
        </table>
        <br>
        <table width="480">
            <tr>
                <td style="font-size: 15px; font-weight: 800">Jadwal Pemetaan</td>
            </tr>
        </table>
        <table width="200" class="table-col" style="border: 1px solid #000; border-collapse: collapse"
            class="bordering">
            <tr>
                <th>Tanggal Pemetaan</th>
                <th>Pukul</th>
            </tr>
            <tr>
                <td>{{ $date }}</td>
                <td>{{ $time }}</td>
            </tr>
        </table>

        <br><br>
        <table>
            <tr>
                <td width="380"><br><br><br><br></td>
                <td class="text" align="center"><br>
                    <img src="{{ public_path('/images/ttd.jpg') }}" alt="" style="width: 50mm">
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
