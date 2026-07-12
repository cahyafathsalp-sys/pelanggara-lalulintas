@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4>Data Petugas</h4>

            <a href="{{ route('petugas.create') }}" class="btn btn-primary">
                Tambah Petugas
            </a>

        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>

                        <th width="50">No</th>
                        <th>User</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Pangkat</th>
                        <th>No HP</th>
                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($petugas as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->user->name }}</td>

                        <td>{{ $item->nip }}</td>

                        <td>{{ $item->nama }}</td>

                        <td>{{ $item->pangkat }}</td>

                        <td>{{ $item->no_hp }}</td>

                        <td>

                            <a href="{{ route('petugas.edit',$item->id) }}"
                               class="btn btn-warning btn-sm">
                               Edit
                            </a>

                            <form
                                action="{{ route('petugas.destroy',$item->id) }}"
                                method="POST"
                                style="display:inline-block"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">
                            Belum ada data petugas.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection