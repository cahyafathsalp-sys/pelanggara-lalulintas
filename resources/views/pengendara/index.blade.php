@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4>Data Pengendara</h4>

            <a href="{{ route('pengendara.create') }}" class="btn btn-primary">
                Tambah Pengendara
            </a>

        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Pencarian -->
            <form action="{{ route('pengendara.index') }}" method="GET">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari Nama / NIK / No SIM"
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

                        <th width="60">No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No SIM</th>
                        <th width="170">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($pengendara as $item)

                    <tr>

                        <td>{{ $pengendara->firstItem() + $loop->index }}</td>

                        <td>{{ $item->nik }}</td>

                        <td>{{ $item->nama }}</td>

                        <td>{{ $item->alamat }}</td>

                        <td>{{ $item->no_sim }}</td>

                        <td>

                            <a href="{{ route('pengendara.edit',$item->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form
                                action="{{ route('pengendara.destroy',$item->id) }}"
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

                        <td colspan="6" class="text-center">

                            Data Pengendara Belum Ada

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="d-flex justify-content-center">

                {{ $pengendara->links() }}

            </div>

        </div>

    </div>

</div>

@endsection