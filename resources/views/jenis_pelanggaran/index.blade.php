@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h4>Data Jenis Pelanggaran</h4>

            <a href="{{ route('jenis-pelanggaran.create') }}" class="btn btn-primary">
                Tambah Jenis Pelanggaran
            </a>

        </div>

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <form action="{{ route('jenis-pelanggaran.index') }}" method="GET">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari Pelanggaran atau Pasal"
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
                        <th>Nama Pelanggaran</th>
                        <th>Pasal</th>
                        <th>Denda</th>
                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($jenis as $item)

                <tr>

                    <td>{{ $jenis->firstItem() + $loop->index }}</td>

                    <td>{{ $item->nama_pelanggaran }}</td>

                    <td>{{ $item->pasal }}</td>

                    <td>Rp {{ number_format($item->denda,0,',','.') }}</td>

                    <td>

                        <a href="{{ route('jenis-pelanggaran.edit',$item->id) }}"
                            class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form
                            action="{{ route('jenis-pelanggaran.destroy',$item->id) }}"
                            method="POST"
                            style="display:inline-block"
                            onsubmit="return confirm('Yakin ingin menghapus data?')">

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

                    <td colspan="5" class="text-center">

                        Belum ada data.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

            <div class="d-flex justify-content-center">

                {{ $jenis->links() }}

            </div>

        </div>

    </div>

</div>

@endsection