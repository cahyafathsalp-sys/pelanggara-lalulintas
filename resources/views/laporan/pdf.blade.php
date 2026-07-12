<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<style>

body{

font-family:DejaVu Sans;

font-size:12px;

}

table{

width:100%;

border-collapse:collapse;

}

table,th,td{

border:1px solid black;

}

th,td{

padding:5px;

}

</style>

</head>

<body>

<h2 align="center">

LAPORAN PELANGGARAN LALU LINTAS

</h2>

<table>

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Pengendara</th>

<th>Kendaraan</th>

<th>Lokasi</th>

<th>Jenis Pelanggaran</th>

</tr>

@foreach($pelanggaran as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->tanggal }}</td>

<td>{{ $item->pengendara->nama }}</td>

<td>{{ $item->kendaraan->nomor_polisi }}</td>

<td>{{ $item->lokasi }}</td>

<td>

@foreach($item->jenisPelanggaran as $j)

{{ $j->nama_pelanggaran }}<br>

@endforeach

</td>

</tr>

@endforeach

</table>

</body>

</html>