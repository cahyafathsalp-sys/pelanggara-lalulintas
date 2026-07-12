@extends('layouts.app')

@section('content')

<div class="container">

<div class="card">

<div class="card-header d-flex justify-content-between">

<h4>Data Pelanggaran</h4>

<a href="{{ route('pelanggaran.create') }}"
class="btn btn-primary">

Tambah Pelanggaran

</a>

</div>

<div class="card-body">

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

<table class="table table-bordered">

<thead class="table-dark">

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Petugas</th>

<th>Pengendara</th>

<th>Kendaraan</th>

<th>Lokasi</th>

<th>Jenis Pelanggaran</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@forelse($pelanggaran as $item)

<tr>

<td>{{ $pelanggaran->firstItem()+$loop->index }}</td>

<td>{{ $item->tanggal }}</td>

<td>{{ $item->petugas->nama }}</td>

<td>{{ $item->pengendara->nama }}</td>

<td>{{ $item->kendaraan->nomor_polisi }}</td>

<td>{{ $item->lokasi }}</td>

<td>

@foreach($item->jenisPelanggaran as $j)

<span class="badge bg-danger">

{{ $j->nama_pelanggaran }}

</span>

@endforeach

</td>

<td>

<a
href="{{ route('pelanggaran.edit',$item->id) }}"
class="btn btn-warning btn-sm">

Edit

</a>

<form
action="{{ route('pelanggaran.destroy',$item->id) }}"
method="POST"
style="display:inline-block">

@csrf
@method('DELETE')

<button
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

Hapus

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="8" class="text-center">

Belum ada data.

</td>

</tr>

@endforelse

</tbody>

</table>

{{ $pelanggaran->links() }}

</div>

</div>

</div>

@endsection