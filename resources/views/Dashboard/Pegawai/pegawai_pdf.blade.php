<!DOCTYPE html>
<html>

<head>
    <title>Absensi PDF</title>

</head>

<body>
    <style type="text/css">
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

    </style>
    <center>
        <h5 style="text-align: center;">Laporan Pegawai</h4>
        </h5>
    </center>

    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomer Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Divisi</th>
                <th>Gambar</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->nomer_pegawai }}</td>
                    <td>{{ $value->nama_lengkap }}</td>
                    <td>{{ $value->job }}</td>
                    <td><img src="assets/images/absen/{{ $value->image }}" alt="{{ $value->nama_lengkap }}"
                            style="height: 60px;"></td>
                    <td>{{ $value->jam_masuk ?: '' }}</td>
                    <td>{{ $value->jam_keluar ?: '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
