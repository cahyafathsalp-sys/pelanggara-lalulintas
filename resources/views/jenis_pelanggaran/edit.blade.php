@extends('layouts.app')

@section('content')

<div class="container">

<div class="card">

<div class="card-header bg-warning">

<h4>Edit Jenis Pelanggaran</h4>

</div>

<div class="card-body">

<form action="{{ route('jenis-pelanggaran.update',$jenis->id) }}" method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Nama Pelanggaran</label>

<input
type="text"
name="nama_pelanggaran"
class="form-control"
value="{{ old('nama_pelanggaran',$jenis->nama_pelanggaran) }}">

</div>

<div class="mb-3">

<label>Pasal</label>

<input
type="text"
name="pasal"
class="form-control"
value="{{ old('pasal',$jenis->pasal) }}">

</div>

<div class="mb-3">

<label>Denda</label>

<input
type="number"
name="denda"
class="form-control"
value="{{ old('denda',$jenis->denda) }}">

</div>

<button class="btn btn-primary">

Update

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