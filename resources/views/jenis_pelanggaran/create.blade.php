@extends('layouts.app')

@section('content')

<div class="container">

<div class="card">

<div class="card-header bg-primary text-white">

<h4>Tambah Jenis Pelanggaran</h4>

</div>

<div class="card-body">

<form action="{{ route('jenis-pelanggaran.store') }}" method="POST">

@csrf

<div class="mb-3">

<label>Nama Pelanggaran</label>

<input
type="text"
name="nama_pelanggaran"
class="form-control"
value="{{ old('nama_pelanggaran') }}">

@error('nama_pelanggaran')
<small class="text-danger">{{ $message }}</small>
@enderror

</div>

<div class="mb-3">

<label>Pasal</label>

<input
type="text"
name="pasal"
class="form-control"
value="{{ old('pasal') }}">

@error('pasal')
<small class="text-danger">{{ $message }}</small>
@enderror

</div>

<div class="mb-3">

<label>Denda</label>

<input
type="number"
name="denda"
class="form-control"
value="{{ old('denda') }}">

@error('denda')
<small class="text-danger">{{ $message }}</small>
@enderror

</div>

<button class="btn btn-success">

Simpan

</button>

<a href="{{ route('jenis-pelanggaran.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

@endsection