@extends('layouts.app')

@section('content')

<div class="container">

<div class="card">

<div class="card-header">

<h4>Laporan Pelanggaran</h4>

</div>

<div class="card-body">

<form action="{{ route('laporan.index') }}" method="GET">

<div class="row">

<div class="col-md-4">

<label>Tanggal Awal</label>

<input
type="date"
name="tanggal_awal"
class="form-control">

</div>

<div class="col-md-4">

<label>Tanggal Akhir</label>

<input
type="date"
name="tanggal_akhir"
class="form-control">

</div>

<div class="col-md-4 mt-4">

<button class="btn btn-primary">

Filter

</button>

<a
href="{{ route('laporan.pdf',request()->all()) }}"
class="btn btn-danger">

Download PDF

</a>

</div>

</div>

</form>

<hr>

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Pengendara</th>

<th>Kendaraan</th>

<th>Lokasi</th>

</tr>

</thead>

<tbody>

@foreach($pelanggaran as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->tanggal }}</td>

<td>{{ $item->pengendara->nama }}</td>

<td>{{ $item->kendaraan->nomor_polisi }}</td>

<td>{{ $item->lokasi }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

@endsection