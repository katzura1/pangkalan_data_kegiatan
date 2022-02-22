<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
</head>

<body>
    <table style="width:100%">
        <tr style="font-size:9px">
            <td style="width:80%">
                <h1>Sistem Informasi Dokumentasi Kegiatan Dewan</h1>
            </td>
            <td style="width:20%;text-align:right" valign="middle">
                <img src="{{ public_path('img/AdminLTELogo.png') }}" style="height: 50px">
            </td>
        </tr>
    </table>
    <hr>
    <table style="width:100%">
        <tr>
            <th style="text-align: left" colspan="3">Data Kegiatan</th>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td style="width: 200px">Nama Kegiatan</td>
            <td style="width: 10px">:</td>
            <td>{{ $item->nama_kegiatan }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Tanggal Kegiatan</td>
            <td style="width: 10px">:</td>
            <td>{{ $item->tanggal_kegiatan }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Lokasi Kegiatan</td>
            <td style="width: 10px">:</td>
            <td>{{ $item->lokasi_kegiatan }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Pelaksana Kegiatan</td>
            <td style="width: 10px">:</td>
            <td>{{ $item->pelaksana_kegiatan }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Nama Pimpinana</td>
            <td style="width: 10px">:</td>
            <td>{{ $item->nama_pimpinan }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Pendamping Kegiatan</td>
            <td style="width: 10px">:</td>
            <td>{{ $item->pendamping }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Deskripsi</td>
            <td style="width: 10px">:</td>
            <td>{{ $item->deskripsi_kegiatan }}</td>
        </tr>
    </table>
    <table style="width:100%">
        <tr>
            <th style="text-align: left" colspan="3">Foto Kegiatan</th>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        @foreach ($item->kegiatan_foto as $foto)
        <tr>
            <td>
                {{-- {{ public_path($foto['foto']) }} --}}
                <img src="{{ public_path('storage/'.$foto['foto']) }}" style="width: 400px;max-height:300px"
                    alt="foto kegiatan">
                <hr>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>