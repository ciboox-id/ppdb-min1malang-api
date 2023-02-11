<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Peserta</title>

    <style>
        * {
            font-family: 'Arial';
            text-transform: uppercase;
        }

        p {
            margin: 0
        }

        .logo-icon {
            width: 90px;
        }

        .wrapper-card {
            padding: 16px;
            width: 18cm;
            height: 21cm;
            border: 2px solid black;
        }

        .wrapper-card table {
            border-color: white;
            border-width: 3px;
            border-style: double;
            width: 100%;
        }

        .line {
            margin: 3px 0;
            width: 100%;
            border: 1px solid black;
        }

        .wrapper-card .table-border,
        .table-border th,
        .table-border td {
            border: 1.5px solid black;
            border-collapse: collapse;
        }

        .grid {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .foto_siswa {
            width: 40px;
            margin: 0 auto;
        }
    </style>

</head>

<body>
    <div class="wrapper-card">
        <table style="margin-top: .5rem;">
            <tr>
                <td style="text-align: center;">
                    <img src="{{ public_path('/images/logo-icon.png') }}" alt="" class="logo-icon">

                    <p>
                        <font style="font-weight: 600;" size="3">Kartu Peserta Pemetaan</font><br>
                    </p>
                    <p>
                        <font style="font-weight: 600;" size="4">PPDB MIN 1 KOTA MALANG</font><br>
                    </p>
                    <p>
                        <font size="2">Tahun Ajaran 2023/2024</font>
                    </p>
                </td>
            </tr>
        </table>
        <div class="line"></div>
        <table>
            <tr>
                <td style="text-align: center; font-size: 40px;">
                    <font size="4">No. Pemetaan : {{ $pemetaan->id }}</font>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="text-align: center;">
                    <img style="width: 48.8mm;height: 68.2mm;" src="{{ public_path($user->foto_siswa) }}" class="foto_siswa">
                </td>
            </tr>
        </table>
        <table style="margin-top: 16px;">
            <tr>
                <td style="text-align: center; font-weight: 600;">
                    <font size="4">{{ $user->nama_lengkap }}</font>
                </td>
            </tr>
        </table><br>
        <table>
            <tr>
                <td style="font-weight: 600;">
                    <font size="2">JADWAL PEMETAAN</font>
                </td>
            </tr>
        </table>
        <table class="table-border" cellpadding="2px">
            <tr>
                <th >
                    <font size="2">Hari/tgl</font>
                </th>
                <th >
                    <font size="2">Pukul</font>
                </th>
            </tr>
            <tr>
                <td style=" text-align: center;">
                    <font size="2">{{ $date }}</font>
                </td>
                <td style=" text-align: center;">
                    <font size="2">{{ $time}}</font>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
