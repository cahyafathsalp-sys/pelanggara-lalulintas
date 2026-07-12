@extends('layouts.app')

@section('content')

<div class="container">

<div class="card">

<div class="card-header">

Tambah User

</div>

<div class="card-body">

<form action="{{ route('users.store') }}" method="POST">

@csrf

<div class="mb-3">

<label>Nama</label>

<input
type="text"
name="name"
class="form-control">

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control">

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control">

</div>

<div class="mb-3">

<label>Role</label>

<select
name="role"
class="form-select">

<option value="admin">

Admin

</option>

<option value="petugas">

Petugas

</option>

</select>

</div>

<button class="btn btn-success">

Simpan

</button>

</form>

</div>

</div>

</div>

@endsection