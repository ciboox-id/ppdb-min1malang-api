<!DOCTYPE html>
<html>

<head>
    <title>Verval PPDB</title>
    <style type="text/css">
        * {
            font-family: 'Times New Roman';
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

        .data-table tr td:last-child {
            width: 350px;
        }

        .data-table tr td p {
            width: 350px;
            margin: 0;
        }

        .data-table tr td span{
            display: block;
        }
    </style>
</head>

<body>
    <center>
        <table width="530">
            <tr>
                <td><img src="{{ asset('images/logo-icon.png') }}" width="90" height="90"></td>
                <td>
                    <center>
                        <font size="4">KEMENTERIAN AGAMA REPUBLIK INDONESIA</font><br>
                        <font size="3">KANTOR KEMENTERIAN AGAMA KOTA MALANG</font><br>
                        <font size="2">MADRASAH IBTIDAIYAH NEGERI 1 KOTA MALANG</font><br>
                        <font size="2">Jl. Bandung 7C Malang, Telepon 0341-551176, Faximile 0341-565642</font>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="border-top:1px solid black"></div>
                </td>
            </tr>
        </table>

        <table width="530" style="text-align: center">
            <tr>
                <td style="font-weight: bold">FORMULIR DAFTAR ULANG SISWA BARU</td>
            </tr>
            <tr>
                <td style="font-weight: bold">TAHUN PELAJARAN 2023/2024</td>
            </tr>
        </table>

        <table width="530">
            <tr>
                <td style="font-weight: bold">
                    A. BIODATA SISWA
                </td>
            </tr>
        </table>

        <table width="530" class="data-table">
            <tr>
                <td>1. Nama (Sesuai Akte Kelahiran)</td>
                <td>: {{ $user->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>2. Nama Panggilan</td>
                <td>: {{ $user->nama_panggilan ?? '' }}</td>
            </tr>
            <tr>
                <td>3. NIK</td>
                <td>: {{ $user->nik }}</td>
            </tr>
            <tr>
                <td>4. NISN</td>
                <td>: {{ $user->nisn }}</td>
            </tr>
            <tr>
                <td>5. Kelas</td>
                <td>: {{ $user->kelas }}</td>
            </tr>
            <tr>
                <td>6. No.Pemetaan</td>
                <td>: {{ str_pad($user->pemetaan->id, 3, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td>7. Tempat Lahir</td>
                <td>: {{ $user->tempat_lahir }}</td>
            </tr>
            <tr>
                <td>8. Tanggal Lahir</td>
                <td>: {{ $user->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>9. Anak ke</td>
                <td>: {{ $user->anak_ke }}</td>
            </tr>
            <tr>
                <td>10. Jumlah Saudara Kandung</td>
                <td>: {{ $user->jumlah_saudara ?? '' }}</td>
            </tr>
            <tr>
                <td>11. Cita-cita </td>
                <td>: {{ $user->cita ?? '' }}</td>
            </tr>
            <tr>
                <td>12. Hobby </td>
                <td>: {{ $user->hobby ?? '' }}</td>
            </tr>
            <tr>
                <td>13. No HP untuk pembelajaran </td>
                <td>: {{ $user->mother->no_telp_ibu }}</td>
            </tr>
            <tr>
                <td>14. Email siswa </td>
                <td>: {{ $user->email }}</td>
            </tr>
            <tr>
                <td>15. Status tempat tinggal </td>
                <td>: {{ $user->status_tempat }}</td>
            </tr>
            <tr>
                <td>16. Alamat tempat tinggal</td>
            </tr>

            {{-- This is sub list --}}
            <tr style="line-height: 1.6">
                <td style="padding-left: 25px">
                    <span>a. jalan</span>
                    <span>b. RT</span>
                    <span>c. RW</sp>
                    <span>d. Desa/Kelurahan</span>
                    <span>e. Kecamatan</span>
                    <span>f. Kota</span>
                    <span>g. Provinsi</span>
                    <span>h. Kode Pos</span>
                </td>
                <td>
                    <p>: {{ $user->alamat_siswa }}</p>
                    <p>: {{ $user->address->rt }}</p>
                    <p>: {{ $user->address->rw }}</p>
                    <p>: {{ $user->address->kelurahan }}</p>
                    <p>: {{ $user->address->kecamatan }}</p>
                    <p>: {{ $user->address->kota_kab }}</p>
                    <p>: {{ $user->address->provinsi }}</p>
                    <p>: {{ $user->address->kode_pos }}</p>
                </td>
            </tr>

            <tr>
                <td>17. Transportasi ke sekolah</td>
                <td>: {{ $user->address->transportasi }}</td>
            </tr>
            <tr>
                <td>18. Transportasi ke sekolah</td>
                <td>: {{ $user->address->jarak_rumah }}</td>
            </tr>
            <tr>
                <td>19. Waktu tempuh ke madrasah</td>
                <td>: {{ $user->address->waktu_tempuh }}</td>
            </tr>
        </table>

        <table width="530">
            <tr>
                <td style="font-weight: bold">
                    B. BIODATA AYAH KANDUNG
                </td>
            </tr>
        </table>

        <table width="530" class="data-table">
            <tr>
                <td>1. Nama (Sesuai Akte Kelahiran)</td>
                <td>: {{ $user->father->nama_lengkap_ayah }}</td>
            </tr>
            <tr>
                <td>2. Gelar depan</td>
                <td>: {{ $user->father->gelar_depan }}</td>
            </tr>
            <tr>
                <td>3. Gelar Belakang</td>
                <td>: {{ $user->father->gelar_belakang }}</td>
            </tr>
            <tr>
                <td>4. Status</td>
                <td>: {{ $user->father->status }}</td>
            </tr>
            <tr>
                <td>5. NIK</td>
                <td>: {{ $user->father->nik_ayah }}</td>
            </tr>
            <tr>
                <td>6. Tempat Lahir</td>
                <td>: {{ $user->father->tempat_lahir_ayah }}</td>
            </tr>
            <tr>
                <td>7. Tanggal Lahir</td>
                <td>: {{ $user->father->tanggal_lahir_ayah }}</td>
            </tr>
            <tr>
                <td>8. Pendidikan terakhir</td>
                <td>: {{ $user->father->pend_terakhir_ayah }}</td>
            </tr>
            <tr>
                <td>9. Pekerjaan</td>
                <td>: {{ $user->father->pekerjaan_ayah }}</td>
            </tr>
            <tr>
                <td>10. Nama Kantor / Tempat Kerja</td>
                <td>: {{ $user->father->nama_kantor_ayah }}</td>
            </tr>
            <tr>
                <td>11. Penghasilan </td>
                <td>: {{ $user->father->penghasilan_ayah }}</td>
            </tr>
            <tr>
                <td>12. No. HP </td>
                <td>: {{ $user->father->no_telp_ayah }}</td>
            </tr>
        </table>

        <table width="530">
            <tr>
                <td style="font-weight: bold">
                    B. BIODATA IBU KANDUNG
                </td>
            </tr>
        </table>

        <table width="530" class="data-table">
            <tr>
                <td>1. Nama (Sesuai Akte Kelahiran)</td>
                <td>: {{ $user->mother->nama_lengkap_ibu }}</td>
            </tr>
            <tr>
                <td>2. Gelar depan</td>
                <td>: {{ $user->mother->gelar_depan }}</td>
            </tr>
            <tr>
                <td>3. Gelar Belakang</td>
                <td>: {{ $user->mother->gelar_belakang }}</td>
            </tr>
            <tr>
                <td>4. Status</td>
                <td>: {{ $user->mother->status }}</td>
            </tr>
            <tr>
                <td>5. NIK</td>
                <td>: {{ $user->mother->nik_ibu }}</td>
            </tr>
            <tr>
                <td>6. Tempat Lahir</td>
                <td>: {{ $user->mother->tempat_lahir_ibu }}</td>
            </tr>
            <tr>
                <td>7. Tanggal Lahir</td>
                <td>: {{ $user->mother->tanggal_lahir_ibu }}</td>
            </tr>
            <tr>
                <td>8. Pendidikan terakhir</td>
                <td>: {{ $user->mother->pend_terakhir_ibu }}</td>
            </tr>
            <tr>
                <td>9. Pekerjaan</td>
                <td>: {{ $user->mother->pekerjaan_ibu }}</td>
            </tr>
            <tr>
                <td>10. Nama Kantor / Tempat Kerja</td>
                <td>: {{ $user->mother->nama_kantor_ibu }}</td>
            </tr>
            <tr>
                <td>11. Penghasilan </td>
                <td>: {{ $user->mother->penghasilan_ibu }}</td>
            </tr>
            <tr>
                <td>12. No. HP </td>
                <td>: {{ $user->mother->no_telp_ibu }}</td>
            </tr>
        </table>

        <table width="530">
            <tr>
                <td style="font-weight: bold">
                    D. BIODATA WALI (jika ada)
                </td>
            </tr>
        </table>

        <table width="530" class="data-table">
            <tr>
                <td>1. Hubungan wali dengan siswa</td>
                <td>: {{ $user->wali->hub_siswa ?? '' }}</td>
            </tr>
            <tr>
                <td>2. Pendidikan</td>
                <td>: {{ $user->wali->pend_wali ?? '' }}</td>
            </tr>
            <tr>
                <td>3. Pekerjaan</td>
                <td>: {{ $user->wali->pekerjaan_wali ?? '' }}</td>
            </tr>
            <tr>
                <td>4. Kantor</td>
                <td>: {{ $user->wali->nama_kantor_wali ?? '' }}</td>
            </tr>
            <tr>
                <td>5. NIK</td>
                <td>: {{ $user->wali->nik ?? '' }}</td>
            </tr>
            <tr>
                <td>6. Alamat tempat tinggal</td>
                <td>: {{ $user->wali->alamat_wali ?? '' }}</td>
            </tr>

            <tr style="line-height: 1.6">
                <td style="padding-left: 25px">
                    <span>a. jalan</span>
                    <span>b. RT</span>
                    <span>c. RW</sp>
                    <span>d. Desa/Kelurahan</span>
                    <span>e. Kecamatan</span>
                    <span>f. Kota</span>
                    <span>g. Provinsi</span>
                    <span>h. Kode Pos</span>
                </td>
                <td>
                    <p>: {{ $user->alamat_siswa }}</p>
                    <p>: {{ $user->address->rt }}</p>
                    <p>: {{ $user->address->rw }}</p>
                    <p>: {{ $user->address->kelurahan }}</p>
                    <p>: {{ $user->address->kecamatan }}</p>
                    <p>: {{ $user->address->kota_kab }}</p>
                    <p>: {{ $user->address->provinsi }}</p>
                    <p>: {{ $user->address->kode_pos }}</p>
                </td>
            </tr>

            <tr>
                <td>7. No. HP</td>
                <td>: {{ $user->wali->no_hp ?? '' }}</td>
            </tr>

        </table>

        <table width="530">
            <tr>
                <td style="font-weight: bold">
                    E. Pernyataan Orang tua / Wali
                </td>
            </tr>
            <tr>
                <td>
                    1. Data yang yang tertulis dalam formulir daftar ulang ini telah diisi dan dicek kebenarannya.
                </td>
            </tr>
            <tr>
                <td>
                    2. Kami siap bekerjasama dengan madrasah untuk kesuksesan pembelajaran anak kami di MIN 1 Kota
                    Malang
                </td>
            </tr>
        </table>

        <br><br>
        <table>
            <tr>
                <td width="180"><br><br><br><br></td>
                <td class="text"><br>
                    <img src="{{ asset('/images/ttd.jpg') }}" alt="" style="width: 50mm">
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
