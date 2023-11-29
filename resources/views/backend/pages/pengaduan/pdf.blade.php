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

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>DATA PENGADUAN</h1>
    <h2>Periode {{Carbon::parse($start)->isoFormat('D MMMM YYYY')}} - {{Carbon::parse($end)->isoFormat('D MMMM YYYY')}}</h2>

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
            @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Carbon::parse($item->tanggal)->isoFormat('dddd/DD MMMM YYYY')}}</td>
                    <td>{{ ucwords($item->user->nama) }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $item->jenis_pengaduan)) }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $item->status_pengaduan)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
