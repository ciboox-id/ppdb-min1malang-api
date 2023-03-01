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
        }

        table tr .text {
            text-align: center;
        }

        table tr td {
            font-size: 13px;
            padding: 3px;
        }

        .table-col tr td {
            text-align: center;
        }
    </style>
</head>

<body>
    <center>
        <table width="530">
            <tr>
                <td><img src="{{ public_path('/images/result/pengumuman.png') }}" width="90" height="90"></td>
                <td>
                    <center>
                        <font size="4">KEMENTERIAN AGAMA REPUBLIK INDONESIA</font><br>
                        <font size="3">KANTOR KEMENTERIAN AGAMA KOTA MALANG</font><br>
                        <font size="2">MADRASAH IBTIDAIYAH NEGERI 1 KOTA MALANG</font><br>
                        <font size="2">Jl. Bandung 7C Malang, Telepon 0341-551176, Faximile 0341-565642</font>
                        <font size="2">Website: https://www.min1kotamalang.sch.id Email: info@min1kotamalang.sch.id
                        </font>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="border-top:1px solid black"></div>
                </td>
            </tr>
        </table>
        <table width="530">
            <tr class="text2">
                <td>Nomer</td>
                <td width="572">: B-114/mi.15.25.1/2/PP.00.55/03/2023</td>
            </tr>
            <tr>
                <td>Hal.</td>
                <td width="564">: Pengumuman Hasil Pemetaan Calon Peserta Didik Baru</td>
            </tr>
        </table>
        <br>
        <table width="530">
            <tr>
                <td>
                    <font size="2">Kepada: <br>Yth Bapak/Ibu Orang Tua / Wali dari : <br>
                        <b>{{ $user->nama_lengkap }} / No. Pemetaan :
                            {{ str_pad($user->pemetaan->id, 3, '0', STR_PAD_LEFT) }}</b>
                        <br>
                        Di Malang
                    </font>
                </td>
            </tr>
        </table>

        <br>

        <table width="530">
            <tr>
                <td>
                    Bersama ini kami sampaikan dengan hormat hasil pemetaan kesiapan belajar yang diselenggarakan oleh
                    Panitia Penerimaan Peserta Didik Baru (PPDB) MIN 1 Kota Malang tahun ajaran 2023/2024 terhadap
                    putra/putri Bapak/Ibu sebagai berikut:
                </td>
            </tr>
        </table>

        <br>

        <table width="530" style="margin-left: 5rem; ">
            <tr style="font-weight: bold">
                <td>No. </td>
                <td>Uraian Pemetaan</td>
                <td>Skor</td>
                <td>Keterangan</td>
            </tr>
            <tr>
                <td>1.</td>
                <td>Kemandirian</td>
                <td>{{ $user->score->mandiri }}</td>
                <td>(Skor Maksimal 250)</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Wawancara Umum</td>
                <td>{{ $user->score->umum }}</td>
                <td>(Skor Maksimal 525)</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Wawancara agama</td>
                <td>{{ $user->score->agama }}</td>
                <td>(Skor Maksimal 870)</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Uji Tahfidz</td>
                <td>{{ $user->score->uji_tahfidz ?? 0 }}</td>
                <td>(Skor Maksimal 600)</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Prestasi</td>
                <td>{{ $user->score->prestasi }}</td>
                <td>(Skor Maksimal 800)</td>
            </tr>
            <tr style="font-weight: bold">
                <td></td>
                <td>Total Skor</td>
                <td>{{ $user->score->prestasi + $user->score->umum + $user->score->agama + $user->score->uji_tahfidz + $user->score->mandiri }}
                </td>
                <td>(Skor minimal diterima 866)</td>
            </tr>

        </table>

        <br>
        <table width="530">
            <tr>
                <td style="text-align: center">Berdasarkan Hasil pemetaan di atas, maka putra/putri Bapak/Ibu dinyatakan
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <b style="padding:3px 5px; font-weight: bold">
                        @if ($user->lolos)
                            DITERIMA
                        @elseif($user->is_backup)
                            CADANGAN {{ $user->kelas }}
                        @else
                            TIDAK DITERIMA
                        @endif
                    </b>
                </td>
            </tr>
            <tr>
                @if ($user->kelas && !$user->is_backup)
                    <td style="text-align: center">
                        <b>
                            DI KELAS 1{{ $user->kelas }}
                        </b>
                    </td>
                @endif
            </tr>
        </table>

        <br>
        <table width="530">
            <tr>
                <td>Demikian pengumuman hasil pemetaan ini, atas perhatian dan kerjasama Bapak/Ibu Orang tua / Wali
                    selama kegiatan pemetaan disampaikan terima kasih.</td>
            </tr>
        </table>

        <br><br>
        <table>
            <tr>
                <td width="340"><br><br><br><br></td>
                <td class="text"><br>
                    <img src="{{ public_path('/images/ttd.png') }}" alt="" style="width: 60mm">
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
