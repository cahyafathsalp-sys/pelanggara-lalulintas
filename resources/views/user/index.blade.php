@extends('layouts.app')

@section('content')

<div class="container">

<div class="card">

<div class="card-header d-flex justify-content-between">

<h4>Manajemen User</h4>

<a href="{{ route('users.create') }}"
class="btn btn-primary">

Tambah User

</a>

</div>

<div class="card-body">

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>

<th>Nama</th>

<th>Email</th>

<th>Role</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@foreach($users as $user)

<tr>

<td>{{ $users->firstItem()+$loop->index }}</td>

<td>{{ $user->name }}</td>

<td>{{ $user->email }}</td>

<td>

@if($user->role=="admin")

<span class="badge bg-danger">

Admin

</span>

@else

<span class="badge bg-success">

Petugas

</span>

@endif

</td>

<td>

<a
href="{{ route('users.edit',$user->id) }}"
class="btn btn-warning btn-sm">

Edit

</a>

<form
action="{{ route('users.destroy',$user->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus user?')">

Hapus

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

{{ $users->links() }}

</div>

</div>

</div>

@endsection