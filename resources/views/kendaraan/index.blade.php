@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h4>Data Kendaraan</h4>

            <a href="{{ route('kendaraan.create') }}" class="btn btn-primary">
                Tambah Kendaraan
            </a>

        </div>

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <form action="{{ route('kendaraan.index') }}" method="GET">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari Plat / Merk / Jenis"
                            value="{{ request('keyword') }}">

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary">

                            Cari

                        </button>

                    </div>

                </div>

            </form>

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>

                        <th>No</th>
                        <th>Pengendara</th>
                        <th>No Polisi</th>
                        <th>Merk</th>
                        <th>Jenis</th>
                        <th>Warna</th>
                        <th>Tahun</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($kendaraan as $item)

                <tr>

                    <td>{{ $kendaraan->firstItem() + $loop->index }}</td>

                    <td>{{ $item->pengendara->nama }}</td>

                    <td>{{ $item->nomor_polisi }}</td>

                    <td>{{ $item->merk }}</td>

                    <td>{{ $item->jenis }}</td>

                    <td>{{ $item->warna }}</td>

                    <td>{{ $item->tahun }}</td>

                    <td>

                        <a href="{{ route('kendaraan.edit',$item->id) }}"
                            class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form
                            action="{{ route('kendaraan.destroy',$item->id) }}"
                            method="POST"
                            style="display:inline-block"
                            onsubmit="return confirm('Yakin ingin menghapus?')">

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

                    <td colspan="8" class="text-center">

                        Belum ada data kendaraan.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

            <div class="d-flex justify-content-center">

                {{ $kendaraan->links() }}

            </div>

        </div>

    </div>

</div>

@endsection