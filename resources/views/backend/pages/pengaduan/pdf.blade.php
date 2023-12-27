@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Export PDF</title>
    <style>
        body {
            text-align: center;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        h2 {
            color: #555;
            font-size: 20px;
            margin-top: 0;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .kop-surat {
            margin: 0 auto;
            width: 80%;
        }

        .kop-surat th,
        .kop-surat td {
            border: transparent;
            padding: 0;
        }

        .kop-surat img {
            display: block;
            margin: auto;
            margin-bottom: 5px;
            width: 100%;
            height: auto;
        }

        .kop-surat .logo-gowa {
            width: 140px;
            height: 80px;
        }

        .kop-surat .teks-surat {
            text-align: center;
            width: 100%;
            margin: 10px auto;
        }

        .kop-surat .teks-surat h2 {
            text-transform: uppercase;
            color: #000;
            font-size: 16px;
            margin: 0;
        }

        .kop-surat .teks-surat span {
            color: #000;
            font-size: 9px;
            display: block;
            margin-top: 8px;
            margin-bottom: 0px;
        }

        .garis {
            color: #000;
            display: block;
            margin-top: -8px;
        }
    </style>
</head>

<body>

    <table class="kop-surat">
        <tr>
            <td width="14%">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('backend/images/logo-gowa.png'))) }}"
                    alt="logo-gowa" class="logo-gowa">

            </td>
            <td colspan="2" width="100%">
                <div class="teks-surat">
                    <h2>Perusahaan Umum Daerah Air Minum</h2>
                    <h2>"Tirta Jeneberang"</h2>
                    <h2>Kabupaten Gowa</h2>
                    <span>Jl. Tirta Jeneberang No. 17 Telp. (0411) 8220242 Email.
                        perumdatirtajeneberang@gmail.com</span>
                </div>
            </td>
            <td width="14%">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('backend/images/logo-pdam.png'))) }}"
                    alt="logo-pdam">
            </td>
        </tr>
    </table>
    <hr width="80%" class="garis">

    <h1>DATA PENGADUAN</h1>
    <h2>Periode {{ Carbon::parse($start)->isoFormat('D MMMM YYYY') }} -
        {{ Carbon::parse($end)->isoFormat('D MMMM YYYY') }}</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Jenis</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Carbon::parse($item->tanggal)->isoFormat('dddd/DD MMMM YYYY') }}</td>
                    <td>{{ ucwords($item->user->nama) }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $item->jenis_pengaduan)) }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $item->status_pengaduan)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
