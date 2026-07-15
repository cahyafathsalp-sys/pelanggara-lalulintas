@extends('layouts.app')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

<style>

.page-title{
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:white;
    padding:20px;
    border-radius:15px;
    margin-bottom:20px;
}

.card-custom{
    border:none;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.table thead{
    background:#2563eb;
    color:white;
}

.table tbody tr:hover{
    background:#f8f9ff;
    transition:.3s;
}

.badge-jenis{
    background:#2563eb;
    color:white;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
}

.search-box{
    position:relative;
}

.search-box i{
    position:absolute;
    left:15px;
    top:12px;
    color:#999;
}

.search-box input{
    padding-left:40px;
    border-radius:10px;
}

.btn-action{
    width:35px;
    height:35px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:8px;
}

</style>

<div class="container">

    <div class="page-title d-flex justify-content-between align-items-center">

        <div>
            <h3 class="mb-1">
                <i class="fas fa-car me-2"></i>
                Data Kendaraan
            </h3>
            <small>Kelola seluruh data kendaraan</small>
        </div>

        <a href="{{ route('kendaraan.create') }}" class="btn btn-light">

            <i class="fas fa-plus"></i>

            Tambah Kendaraan

        </a>

    </div>

    @if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        <i class="fas fa-circle-check me-2"></i>

        {{ session('success') }}

        <button class="btn-close" data-bs-dismiss="alert"></button>

    </div>

    @endif

    <div class="card card-custom">

        <div class="card-body">

            <form action="{{ route('kendaraan.index') }}" method="GET">

                <div class="row mb-4">

                    <div class="col-md-5">

                        <div class="search-box">

                            <i class="fas fa-search"></i>

                            <input
                                type="text"
                                name="keyword"
                                class="form-control"
                                placeholder="Cari nomor polisi, merk, jenis..."
                                value="{{ request('keyword') }}">

                        </div>

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary w-100">

                            <i class="fas fa-search"></i>

                            Cari

                        </button>

                    </div>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Pengendara</th>

                            <th>No Polisi</th>

                            <th>Merk</th>

                            <th>Jenis</th>

                            <th>Warna</th>

                            <th>Tahun</th>

                            <th width="120">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($kendaraan as $item)

                    <tr>

                        <td>

                            {{ $kendaraan->firstItem()+$loop->index }}

                        </td>

                        <td>

                            <strong>{{ $item->pengendara->nama }}</strong>

                        </td>

                        <td>

                            <span class="badge bg-dark">

                                {{ $item->nomor_polisi }}

                            </span>

                        </td>

                        <td>{{ $item->merk }}</td>

                        <td>

                            <span class="badge-jenis">

                                {{ $item->jenis }}

                            </span>

                        </td>

                        <td>{{ $item->warna }}</td>

                        <td>{{ $item->tahun }}</td>

                        <td>

                            <a href="{{ route('kendaraan.edit',$item->id) }}"
                               class="btn btn-warning btn-sm btn-action">

                                <i class="fas fa-pen"></i>

                            </a>

                            <form
                                action="{{ route('kendaraan.destroy',$item->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm btn-action">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center py-5">

                            <i class="fas fa-car fa-3x text-secondary mb-3"></i>

                            <br>

                            Belum ada data kendaraan.

                        </td>

                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-4 d-flex justify-content-center">

                {{ $kendaraan->links() }}

            </div>

        </div>

    </div>

</div>

@endsection