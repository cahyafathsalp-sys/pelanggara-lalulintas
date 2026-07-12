@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-warning text-dark">
            <h4>Edit Data Pengendara</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('pengendara.update', $pengendara->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">NIK</label>

                    <input
                        type="text"
                        name="nik"
                        class="form-control"
                        value="{{ old('nik', $pengendara->nik) }}"
                    >

                    @error('nik')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Pengendara</label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama', $pengendara->nama) }}"
                    >

                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="4"
                    >{{ old('alamat', $pengendara->alamat) }}</textarea>

                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor SIM</label>

                    <input
                        type="text"
                        name="no_sim"
                        class="form-control"
                        value="{{ old('no_sim', $pengendara->no_sim) }}"
                    >

                    @error('no_sim')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('pengendara.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

@endsection